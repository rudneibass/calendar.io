<nav class="navbar navbar-expand-lg navbar-light bg-dark" >
    <div style="width: 90%; margin: auto; display: flex; justify-content: space-between; align-items: end">
        
        <div style="padding: 5px; display: flex">
            <div class="imagem-vereador" style="background-image: url(<?php echo $_SESSION['USUARIO_IMAGEM']; ?>);"></div>
            <div style="display: flex; align-items: end; padding: 0 15px">
                <div>
                    <span class="nome-vereador"> <?php echo $_SESSION['USUARIO_NOME']; ?></span><br/>
                    <span class="text-muted"><?php echo $_SESSION['RAZAO_SOCIAL']; ?></span>
                </div>
            </div>
        </div>
        
        <div style="padding: 6px 0px">
            <a style="color: white; text-decoration: none" href="?sair-votacao=sair-votacao">
                <h4>
                    <i class="fa fa-power-off"></i>
                    Sair
                </h4>
            </a>
        </div>
        

    </div>
</nav>

<style>
    
    /*nav {
        background:rgba(0, 0, 0, 0.5); 
        padding: 10px 0; 
        width: 100%;
        height: 15vh;
    } */
     
    .nome-vereador {
        color: white; 
        text-transform: uppercase;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .imagem-vereador {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        /*background-image: url('https://media.istockphoto.com/id/1386479313/pt/foto/happy-millennial-afro-american-business-woman-posing-isolated-on-white.jpg?s=2048x2048&w=is&k=20&c=Sl6LA2KgwmoI6sFAXOdJ809XUKLJP3AAbTplqQTpJy8=');
        */
        background-size: cover;
        background-position: center;
    }
</style>