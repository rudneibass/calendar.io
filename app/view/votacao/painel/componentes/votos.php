<?php 

  class MateriaVotos {
    public $materia = array();
    public $votos = array();
    public $con = null;
    
    public function __construct(){
        $this->con = new PDO(''.$_SESSION['DB_TYPE'].':host='.$_SESSION['DB_HOST'].';dbname='.$_SESSION['DB_NAME'].';charset=utf8', '' . $_SESSION['DB_USER'] . '', '' . $_SESSION['DB_PASS'] . '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->materia();
        if(isset($this->materia['id_materias']) && !empty($this->materia['id_materias'])){
           $this->materiaVotos($this->materia['id_materias']);
        }
    }

    private function materia(){
        $sqlSelect = 
        $this->con
        ->prepare("
            SELECT * 
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

    private function materiaVotos($idMaterias){
        $sqlSelect = 
        $this->con
        ->prepare("SELECT * FROM materias_votos LEFT JOIN servidor ON servidor.id = materias_votos.id_servidor WHERE id_materias = {$idMaterias}");
        $sqlSelect->execute();
        $this->votos = $sqlSelect->fetchAll(); 
    }

  }

  $class = new MateriaVotos();

?>

<div class="progress-container">
  <div class="progress-bar" id="progressBar"></div>
</div>

<div style="width: 95%; margin:auto">
    <br/>
    <div class="row">      
        <?php if(!$class->materia): ?>
            <img class="m-auto" src="<?php echo $_SESSION['LOGO_ENTIDADE']; ?>" style="width: 30%" />
            <p style="color: #ddd; text-align: center">
              Aguarde, estamos preparando tudo! Em breve você vai poder<br/> 
              acompanhar todas as votações em tempo real.
            </p>
        <?php endif; ?>
      <?php foreach($class->votos as $voto): ?>
        <div class="col-3 wow fadeInd">
            <div class="card mb-3 border" style="max-width: 540px; max-height: 250px; background:rgba(55, 59, 62, 0.8); color: white">
              <div class="row g-0">
                <!-- <div class="col-md-3 imagem-vereador" style="background-image: url('https://img.freepik.com/fotos-gratis/retrato-de-mulher-bonita-em-close-up_23-2148677647.jpg?t=st=1733346179~exp=1733349779~hmac=3c59f08432ce30013620c714f84635518be42a35448983280d18478b8321bf96&w=740');"> -->
                <div class="col-md-3 imagem-vereador" style="background-image: url('<?php echo $voto['imagem_url']; ?>');">
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5 class="card-title" style="text-transform: uppercase;"><?php echo $voto['nome_eleitoral'] ?? $voto['nome']; ?></h5>
                    <p style="font-size: medium;"><?php echo $voto['partido']; ?></p>
                    
                    <?php if($voto['voto'] === 'S'): ?>
                      <p class="card-text bg-success d-flex justify-content-center align-items-center">
                        <small>Favorável</small>
                      </p>
                    <?php endif; ?>
                    
                    <?php if($voto['voto'] === 'N'): ?>
                      <p class="card-text bg-danger d-flex justify-content-center align-items-center">
                        <small>Contra</small>
                      </p>
                    <?php endif; ?>
                    
                    <?php if($voto['voto'] === 'ABS' ?? $voto['voto'] == null): ?>
                      <p class="card-text bg-secondary d-flex justify-content-center align-items-center">
                        <small>Não votou</small>
                      </p>
                    <?php endif; ?>

                    <?php if($voto['voto'] == null): ?>
                      <p class="card-text bg-secondary d-flex justify-content-center align-items-center">
                        <small>Não votou</small>
                      </p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
      <?php endforeach; ?>

    </div>
</div>

<style>
  .imagem-vereador {
    position: relative;
    background-color: #373B3E;
    background-size: 100% 100%;
    background-repeat: no-repeat;
  }
</style>


<style>
    .progress-bar {
        width: 0%;
        height: 3px;
        background-color: #4caf50;
    }

    .progress-container {
        width: 100%;
        background-color: #ddd;
        border-radius: 5px;
    }
</style>
<script>
  function resetProgressBar() {
        const progressBar = document.getElementById("progressBar");
        progressBar.style.transition = "none";
        progressBar.style.width = "0%";

        setTimeout(() => {
            progressBar.style.transition = "width 10s linear";
            progressBar.style.width = "100%";
        }, 50);

        //setTimeout(fetchData, 10000);
        setTimeout(sessaoAberta, 12000);
    }

    resetProgressBar();
</script>