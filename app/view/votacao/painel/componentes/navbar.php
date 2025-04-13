<?php 
  session_start();

  class Navbar {
    public $materia = array();
    public $materiaVotos = array();
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

    private function materiaVotos($idMaterias){
        $sqlSelect = 
        $this->con
        ->prepare("SELECT * FROM materias_votos WHERE id_materias = {$idMaterias}");
        $sqlSelect->execute();
        $votos = $sqlSelect->fetchAll();

        $sCount = 0;
        $nCount = 0;
        $absCount = 0;

        foreach ($votos as $item) {
            if (isset($item['voto'])) {
                switch ($item['voto']) {
                    case 'S':
                        $sCount++;
                        break;
                    case 'N':
                        $nCount++;
                        break;
                    case 'ABS':
                        $absCount++;
                        break;
                }
            }
        }

        $this->materiaVotos = 
        array(
            'S' => $sCount < 10 ? '0'.(string)$sCount : $sCount,
            'N' => $nCount < 10 ? '0'.(string)$nCount : $nCount,
            'ABS' => $absCount < 10 ? '0'.(string)$absCount : $absCount,
        );
    }
  }

  $navbar = new Navbar();
?>


<nav class="navbar navbar-expand-lg navbar-light bg-dark container-fluid">
    <div style="display: flex; justify-content: space-between; align-items: center; width: 95%; margin:auto">
        <div style="display: flex; width: 75%">
            <div style="display: flex; align-items: center; ">
                <div>
                    <span class="titulo-materia"> 
                        <?php echo $navbar->materia['materia_tipo'] ?? '';?>
                        <?php echo $navbar->materia['materia_numero'] ?? ''; ?>
                    </span><br/>
                    <span style="color: #FFC107; text-transform: uppercase; font-size: 1.2rem;">
                        <?php echo $navbar->materia['materia_descricao'] ?? ''; ?>
                    </span>
                    <p style="color: #FFFFFF; font-size: .75rem">
                        <?php echo $navbar->materia['sessao_descricao'] ?? ''; ?>
                    </p>
                </div>
            </div>
        </div>       
        
        <div style="padding: 0px 0px 15px 0px; display: flex;">
            <div style="padding-right: 20px">
                <div class="p-1">
                    <span class="bg-success" style="font-size: .75rem;">&emsp;</span>
                    &nbsp;
                    <span  style="color: white; font-size: .75rem;">Favorável</span>
                </div>
                <div class="p-1">
                    <span class="bg-danger" style="font-size: .75rem;">&emsp;</span>
                    &nbsp;
                    <span  style="color: white; font-size: .75rem;">Contra</span>
                </div>
                <div class="p-1">
                    <span class="bg-info" style="font-size: .75rem;">&emsp;</span>
                    &nbsp;
                    <span  style="color: white; font-size: .75rem;">Abstensões</span>
                </div>
            </div>
            <div>
                <span style="color: white">Placar</span>
                <hr style="color: white; margin-top: 5px"/>
                <span class="bg-success p-2 color-white" style="color: white; font-size: 2rem; font-weight: 500"><?php echo $navbar->materiaVotos['S'] ?? '00'; ?></span>
                &nbsp;
                <span class="bg-danger p-2 color-white" style="color: white; font-size: 2rem; font-weight: 500"><?php echo $navbar->materiaVotos['N'] ?? '00'; ?></span>
                &nbsp;
                <span class="bg-info p-2 color-white" style="color: white; font-size: 2rem; font-weight: 500"><?php echo $navbar->materiaVotos['ABS'] ?? '00'; ?></span>
            </div>
        </div>
    </div>
</nav>

<style>
    
    .titulo-materia {
        color: white; 
        text-transform: uppercase;
        font-size: 1.5rem;
        font-weight: bold;
    }

</style>