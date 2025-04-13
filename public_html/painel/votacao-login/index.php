<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Votação Eletrônica</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <!-- BOOTSTRAP 4.0 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- FONT AWSOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- TOAST -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="../style.css">

    </head>

    <body 
    style="
        background-image: url(plenario.jpg);
        background-repeat: no-repeat;
        background-size: cover;"
        >

        <div class="container-fluid" style="background:rgba(55, 59, 62, 0.8); height: 100vh">

            <div class="row">
                <div class="col-md-4"></div>

                <div class="col-md-4 p-4">

                    <div class="card rounded mt-5" style="background:rgba(55, 59, 62, 0.8);">
                        <div class="card-body py-0">
                            <div id="logo">
                                <br/>
                                <center>
                                    <!-- <img src="../img/logo-w2e.png" class="img-thumbnail" style="background:rgba(55, 59, 62, 0.5); border-top: none; border-left: none; border-right: none; border-radius: 0; border-color: #858585b6;"> -->
                                    <small style="color: white">Bem vindo a nossa</small> 
                                    <h4 style="color: white">Sessão Eletrônica</h4>
                                </center>
                            </div>

                            <hr/>
                            <form id="login"> 
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cpf" required name="cpf">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Senha" required name="senha">
                                </div>

                            </form>

                            <hr/>
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group input-group-sm">
                                        <button class="btn btn-primary btn-block btn-flat btn-lg" onclick="login()"> 
                                            <img class="loading" src="../img/loading-white-sm.svg" style="display: none"/>
                                            <div class="btn-login-label">
                                                <i class="fa fa-unlock-alt"></i> Acessar
                                            </div> 
                                        </button>
                                    </div>
                                </div>
                            </div><!-- .row -->

                        </div><!-- .card-body  -->
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../_ajax/ControllerVotacao.js"></script>
</html>