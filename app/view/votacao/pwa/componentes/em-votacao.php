<?php $emVotacao = $GLOBALS['emVotacao']; ?>

<section>
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <div class="container-resumo-materia">

        <div class="btn btn-sm btn-warning em-votacao mb-3 m-auto">
            EM VOTAÇÃO
            <span class="rec-dot-span">AGORA</span>
            &nbsp;
            <div class="rec-dot"></div>
        </div>
        <span class="resumo-materia">
            <div class="fade-in">
                <p style=" color: white; text-transform: uppercase; font-weight: bold; text-align: center;" class="mb-3"> 
                    <?php echo $emVotacao->materia['materia_tipo'] ?? '';?>
                    <?php echo $emVotacao->materia['materia_numero'] ?? ''; ?>
                </p>
                <p style="color: #FFC107; text-transform: uppercase; "  class="mb-3">
                    <?php echo $emVotacao->materia['materia_descricao'] ?? ''; ?>
                </p>
                <p style="color: #FFFFFF; font-size: 1rem;"  class="mb-3">
                    <?php echo $emVotacao->materia['sessao_descricao'] ?? ''; ?>
                </p>
            </div>
        </span>

    </div>

</section>

<style>
    .container-resumo-materia {
        text-align: center;
        padding: 10px;
        max-height: 52vh;
        overflow-y: auto;
        width: 90%;
        margin: auto;
    }

    .resumo-materia {
        color: white;
        display: inline-block;
        width: 100%;
        text-align: justify;
        font-size: 1.5rem;
    }

    .em-votacao {
        position: relative;
        padding: 0 40px;
        font-size: 1.5rem
    }

    .rec-dot-span {
        display: inline;
        font-weight: bold;
        color: red;
        font-size: 1.5rem
    }

    .rec-dot {
        width: 1.2rem;
        height: 1.2rem;
        background-color: red;
        border-radius: 50%;
        animation: pulse 1s infinite;
        display: inline-block;
        /*vertical-align: middle;*/
        /*margin-right: 5px;*/
        position: absolute;
        top: 0.6rem;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.3);
            opacity: 0.7;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
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
        //setTimeout(sessaoAberta, 10000);
    }

    resetProgressBar();

</script>

