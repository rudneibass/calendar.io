<?php
    require_once '../../_php/Render.php';
    $render = new Render();
    $render->renderScripts(array('Votacao'));
?> 

<section>
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <div class="container-resumo-materia">
        <span class="resumo-materia">
            <div class="btn btn-sm btn-warning em-votacao mb-1">
                EM VOTAÇÃO
                <span class="rec-dot-span">AGORA</span>
                &nbsp;
                <div class="rec-dot"></div>
            </div>
            <span class="resumo-materia-texto fade-in" style="line-height: 1.5rem">
                <b>Aguarde, </b>Em instantes traremos a matéria em votação no momento.
            </span>
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
  
    function sessaoAberta() {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerVotacao&&action=listaSessoes',
            type: 'POST',
            dataType: "json",
            error: function (e) {
                console.log(e.responseText)
                //alert("Erro ao exibir matéria em votação.")
            },
            success: function (response) {
                console.log(response)
                const resumoMateria = document.querySelector(".resumo-materia-texto")
                resumoMateria.classList.remove("fade-in")
                void resumoMateria.offsetWidth
                const novoConteudo = `<b>Aguarde, </b>Em instantes traremos a matéria em votação no momento.`
                resumoMateria.innerHTML = novoConteudo
                resumoMateria.classList.add("fade-in")
                resetProgressBar()
            }
        });
    };



    function resetProgressBar() {
        const progressBar = document.getElementById("progressBar");
        progressBar.style.transition = "none";
        progressBar.style.width = "0%";

        setTimeout(() => {
            progressBar.style.transition = "width 10s linear";
            progressBar.style.width = "100%";
        }, 50);

        //setTimeout(fetchData, 10000);
        setTimeout(sessaoAberta, 10000);
    }

    resetProgressBar();


</script>

