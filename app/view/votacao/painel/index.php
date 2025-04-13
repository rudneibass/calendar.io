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
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

    <style> .wow{ visibility: hidden;}</style>
    <link rel="stylesheet" href="https://wowjs.uk/css/libs/animate.css">
    <script src="https://wowjs.uk/dist/wow.min.js"></script>
    <script> new WOW().init(); </script>

    <script>
        setInterval(function() {
            location.reload(); 
        }, 10000);
    </script>
</head>

<body
    style="
    height: 100vh;
    position: relative;
    background-color: #373B3E;
    background-image: url('assets/plenario.jpg');
    background-size: cover;
    background-repeat: no-repeat;">
    <div style="background:rgba(55, 59, 62, 0.8); height: 100vh">
        <div class="wow fadeIn">
            <?php require_once('../../../app/view/votacao/painel/componentes/navbar.php') ?>
            <main>
                <?php require_once('../../../app/view/votacao/painel/componentes/votos.php') ?>
            </main>
            <?php require_once('../../../app/view/votacao/painel/componentes/footer.php') ?>
        </div>
    </div>
</body>

<style>
    html {
        font-family: 'Open Sans', sans-serif;
    }

    main {
        height: 75vh
    }

    p {
        font-size: 1.5rem;
    }

    @media screen and (max-width: 1340px) {

    }

    @media screen and (max-width: 1080px) {
        html {
            font-size: 93.75%;
        }
    }

    @media screen and (max-width: 825px) {

    }

    @media screen and (max-width: 720px) {
        html {
            font-size: 87.5%;
        }
    }

    @media screen and (max-width: 560px) {
        html {
            font-size: 75%;
        }
    }

    @media screen and (max-width: 470px) {

    }

    @media screen and (max-width: 375px) {
        html {
            font-size: 68.75%;
        }
    }
</style>

</html>