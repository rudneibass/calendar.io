<?php 
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emVotacao = new EmVotacao();
        $emVotacao->votar();
    }

    
    class EmVotacao {
        public $materia = array();
        public $con = null;
        
        public function __construct(){
            $this->con = new PDO(''.$_SESSION['DB_TYPE'].':host='.$_SESSION['DB_HOST'].';dbname='.$_SESSION['DB_NAME'].';charset=utf8', '' . $_SESSION['DB_USER'] . '', '' . $_SESSION['DB_PASS'] . '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->materia();
        }
    
        private function materia(){
            $sqlSelect = 
            $this->con
            ->prepare("
                SELECT * 
                    ,sessoes.descricao AS sessao_descricao 
                    ,materias.id AS id_materias
                    ,materias.descricao AS materia_descricao
                    ,materias.tipo AS materia_tipo
                    ,materias.numero AS materia_numero 
                FROM sessoes 
                    LEFT JOIN sessoes_materias ON sessoes_materias.id_sessoes = sessoes.id
                    LEFT JOIN materias ON materias.id = sessoes_materias.id_materias
                WHERE sessoes.situacao = 'Aberta'
                AND sessoes_materias.aberto = 'S'
                ORDER BY 
                    sessoes.data DESC
                    ,sessoes_materias.ordem ASC;
            ");
            $sqlSelect->execute();   
            $this->materia = $sqlSelect->fetch();
            
            return $this->materia;
        }

        public function votar(){
            try{

                $idMaterias = filter_input(INPUT_POST, 'id_materias', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $idServidor = filter_input(INPUT_POST, 'id_servidor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $voto = filter_input(INPUT_POST, 'voto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $select = 
                $this->con
                ->prepare("SELECT * FROM materias_votos WHERE id_materias = ".$idMaterias." AND  id_servidor = ".$idServidor);
                $select->execute();   
                $votoExistente = $select->fetch(\PDO::FETCH_ASSOC);

                if(count($votoExistente)){
                    $update =
                    $this->con
                    ->prepare("UPDATE materias_votos SET voto ='".$voto."' WHERE id_materias = ".$idMaterias." AND  id_servidor = ".$idServidor);
                    $update->execute();
                };

                if(!count($votoExistente)){
                    $insert =
                    $this->con
                    ->prepare("INSERT INTO materias_votos (voto, id_materias, id_servidor) VALUES ('".$voto."', ".$idMaterias.",".$idServidor.")");
                    $insert->execute();
                };

                echo json_encode(['msg' => 'Voto registrado com sucesso!']);            
                die;
            } catch (Exception $e){
                echo json_encode(['msg' =>$e->getMessage()]);
                die;
            }
        }
    }
    
    $GLOBALS['emVotacao'] = new EmVotacao();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Painel Administrativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- FONT AWSOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    
</head>

<body
    style="
    height: 100vh;
    position: relative;
    background-color: #373B3E;
    background-image: url('plenario.jpg');
    background-size: cover;
    background-position: 50% 100%;
    background-repeat: no-repeat;">
    <div style="background:rgba(55, 59, 62, 0.8); height: 100vh">

        <?php require_once('../../../app/view/votacao/pwa/componentes/navbar.php') ?>

        <main>
        
            <?php require_once('../../../app/view/votacao/pwa/componentes/em-votacao.php') ?>
            <?php require_once('../../../app/view/votacao/pwa/componentes/botoes.php') ?>
        </main>

        <?php require_once('../../../app/view/votacao/pwa/componentes/footer.php') ?>
        <?php require_once('../../../app/view/votacao/pwa/componentes/modal-detalhes.php') ?>
        <?php require_once('../../../app/view/votacao/pwa/componentes/modal-aprovar.php') ?>
        <?php require_once('../../../app/view/votacao/pwa/componentes/modal-rejeitar.php') ?>
        <?php require_once('../../../app/view/votacao/pwa/componentes/modal-abster.php') ?>
        <?php require_once('../../../app/view/votacao/pwa/componentes/modal-carregando.php') ?>
        <?php require_once('../../../app/view/votacao/pwa/componentes/modal-voto-sucesso.php') ?>
    </div>
</body>
<script>
    /*
    setInterval(function() {
        location.reload(); 
    }, 10000); */
</script>
<script>
    const audio = new Audio('click-01.mp3');
    document.querySelectorAll('.btn').forEach(button => {
      button.addEventListener('click', () => {
        audio.play().catch(error => {
          console.error('Erro ao tentar tocar o áudio:', error);
        });
      });
    });
</script>
 
<script>
        function votar({id_servidor, id_materias, voto}) {
            $.ajax({
                url: 'index.php',
                type: 'POST',
                dataType: "json",
                data: {
                    id_servidor, 
                    id_materias, 
                    voto
                },
                beforeSend: function () {
                    $('.modal.show').modal('hide');
                    $("#modalCarregando").modal('show')
                },
                error: function (e) {
                    $("#modalCarregando").modal('hide')
                    alert(e.responseText)
                    console.log(e.responseText)
                },
                success: function (response) {
                    console.log(response.msg)
                    $("#modalCarregando").modal('hide')
                    $('.modal.show').modal('hide');
                    $("#modalVotoSucesso").modal('show')
                }
            });
        };
</script>
<style>
    * { /*transition: all .3s ease;*/ }

    html {
        font-family: 'Open Sans', sans-serif;
    }

    main {
        height: 75vh
    }

    p {
        font-size: 1.5rem;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    @media screen and (max-width: 1340px) {
        .btn3d {
            font-size: 30px;
            width: 250px;
            height: 80px;
        }
    }

    @media screen and (max-width: 1080px) {
        html {
            font-size: 93.75%;
        }

        .rec-dot {
            top: 0.5rem
        }

        .btn3d {
            font-size: 25px;
            width: 200px;
        }
    }

    @media screen and (max-width: 825px) {
        .btn3d {
            font-size: 1.5rem;
            width: 160px;
        }
    }

    @media screen and (max-width: 720px) {
        html {
            font-size: 87.5%;
        }

        .imagem-vereador {
            width: 50px;
            height: 50px;
        }

        .em-votacao {
            padding: 0 30px 0 15px;
        }

        .rec-dot {
            top: 0.5rem
        }

        .btn-row {
            padding: 10px 0px;
        }

        .btns-mobile {
            display: block;
        }

        .btns-desktop {
            display: none;
        }

        .btn3d {
            font-size: 25px;
            width: 200px;
            height: 70px;
        }
    }


    @media screen and (max-width: 560px) {
        html {
            font-size: 75%;
        }

        .rec-dot {
            top: 0.4rem
        }

        .rec-dot-span {
            font-size: 1.2rem;
        }

        .em-votacao {
            font-size: 1.3rem;
            padding: 0 25px 0 10px;
        }

        .container-resumo-materia {
            max-height: 42vh;
        }
    }

    @media screen and (max-width: 470px) {
        .btn3d {
            width: 150px;
            font-size: 20px;
        }

        .imagem-vereador {
            width: 45px;
            height: 45px;
        }
    }

    @media screen and (max-width: 375px) {
        html {
            font-size: 68.75%;
        }
    }
</style>

</html>