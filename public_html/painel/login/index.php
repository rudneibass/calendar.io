<?php
session_start();
$_SESSION['modulo'] = 'painel';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Camara Municipal</title>
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

    <body style="background-color: #f3f3f3">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4"></div>

                <div class="col-md-4 p-4">

                    <div class="card bg-white rounded mt-5">
                        <div class="card-body">
                            <div id="logo">
                                <br/>
                                <center>
                                    <img src="../img/logo-w2e.png" class="img-thumbnail" >
                                </center>
                            </div>

                            <hr/>
                            <form id="login">  
                                <input type="hidden" id="tbl" name="tbl" value="usuarios">
                                <input type="hidden" id="btn" name="btn" value="acessar-painel">


                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Sigla da Entidade" required name="sigla">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nome de Usuário" required name="usuario">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Senha" required name="senha">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-7 mt-1">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="token"  id="token" placeholder="Código de Segurança" required>
                                        </div>
                                    </div>

                                    <div class="col-md-5">                            
                                        <img class="img-thumbnail" src="../captcha/captcha.php" alt="token" class="mb-2">
                                    </div>

                                </div>

                            </form>

                            <hr/>
                            <div class="row">
                                <div class="col-md-4">


                                </div>
                                <div class="col-md-3 pr-0">
                                    <div class="form-group input-group-sm mb-3">
                                        <a href="../../" class="btn btn-secondary btn-block btn-signin btn-sm"> <i class="fa fa-undo"></i> Voltar </a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group input-group-sm mb-3">
                                        <button class="btn btn-primary btn-block btn-flat btn-sm" onclick="login()"> 
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
    <script src="../_ajax/ControllerLogin.js"></script>
    <script src="../_ajax/ControllerOptionSelect.js"></script>


    <script>
                                            masterOptionSelect('master_entidade');

                                            document.onkeydown = function (e) {
                                                if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117 || e.keycode === 17 || e.keycode === 85)) {
                                                    //alert('ok!');
                                                    console.log('ok');
                                                } else {
                                                    exit;
                                                }
                                                return false;
                                            };
    </script>
</html>    