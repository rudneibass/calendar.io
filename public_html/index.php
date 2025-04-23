<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Painel Administrativo</title>
    <!-- Bootstrap 4.0  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Toast Mensege -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous">
    <!-- Style Nativo -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal-messages.css">
</head>

<body style="background-color: #FAFBFC; padding-top: 80px">
    <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar fixed-top">
        <a class="navbar-brand mr-0 mr-md-2" href="/">
            Calendar.io
        </a>
    </header>

    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="position-relative">
                           <!--
                            <div class="card mb-3" style="border-color: #5a3894 !important;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        
                                        <div class="d-flex">
                                            <div style="border-radius: 50%; width: 45px; height: 45px; background-color:rgb(203, 183, 235); display: flex; justify-content: center; align-items: center;">
                                                <span>U</span>
                                            </div>
                                            <div class="px-2" style="display: flex; flex-direction: column; justify-content: center;">
                                                <span style="font-size: 1rem">' . $userRecord['name'] . '</span>
                                                <small class="text-muted">' . strftime('%d de %B de %Y', strtotime('')) . '</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
-->
                            <!-- Grid do calendário -->
                            <div class="d-flex justify-content-between align-items-center py-3 px-4 bg-white" 
                                style="border-radius: 2px !important; border: 1px solid #5a3894 !important;"
                            >
                                <i class="fa fa-chevron-circle-left" style="font-size: 25px; color:#343a40" onclick="loadCalendar({increment: -1, user: 'calendarioComentado'})"></i>
                                <div style="min-width: 200px; text-align: center;">
                                    <span class="gray" id="mesAno" style="font-size: 1.5rem">Calendário</span>
                                </div>
                                <i class="fa fa-chevron-circle-right" style="font-size: 25px; color: #343a40" onclick="loadCalendar({increment: 1, user: 'calendarioComentado'})"></i>
                            </div>
                            <div style="display: flex; flex-wrap: wrap;">
                                <div class="bg-purple weekend-day" >D</div>
                                <div class="bg-dark week-day">S</div>
                                <div class="bg-dark week-day">T</div>
                                <div class="bg-dark week-day">Q</div>
                                <div class="bg-dark week-day" >D</div>
                                <div class="bg-dark week-day" >S</div>
                                <div class="bg-purple weekend-day">S</div>
                            </div>

                            <div id="calendario" style="display: flex; flex-wrap: wrap;">
                            </div>
                            <div class="loading">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2" id="aside">
                        <div class="alert alert-dark bg-purple color-white" role="alert">
                            <strong>Brasília:</strong>
                            <h4 id="time-brasilia">--:--</h4>
                        </div>
                        <div class="alert bg-dark color-white" role="alert">
                            <strong>Nova York:</strong>
                            <h4 id="time-new-york">--:--</h4>
                        </div>
                        <div class="alert bg-dark color-white" role="alert">
                            <strong>Londres:</strong>
                            <h4 id="time-london">--:--</h4>
                        </div>
                        <div class="alert bg-dark color-white" role="alert">
                            <strong>Tóquio:</strong>
                            <h4 id="time-tokyo">--:--</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br />
        <br />
        <section>
            <div class="container">
                <div class="row" id="users_list">

                </div>
            </div>
        </section>

    </main>



    <section>
        <div class="modal fade" id="modal_groups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="z-index: 10000;">
                <div class="modal-content">
                    <div class="d-flex justify-content-between px-3 py-2 bg-purple">
                        <h6 class="modal-title" id="exampleModalLabel" style="color: white"><i class="fa fa-comments"></i> Grupos</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="color-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="list_groups"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="modal fade" id="modal_messages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="z-index: 10000;">
                <div class="modal-content">
                    <div class="d-flex justify-content-between px-3 py-2 bg-purple">
                        <h6 class="modal-title" id="exampleModalLabel" style="color: white"><i class="fa fa-comments"></i> Mensagens</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="color-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div class="message-hub px-4">
                            <div class="message-container">
                                <div class="message-bubble">
                                    <div class="message-text">
                                        Oi! Tudo bem? Oi! Tudo bem? Oi! Tudo bem? Oi! Tudo bem? 😊
                                    </div>
                                    <div class="message-time">
                                        14:32
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="border-radius: 0px 0px 10px 10px; background-color:#7952b3; padding: 10px 0">
                            <form id="tab-1-form-1">
                                <input type="date" name="data_publicacao" class="d-none" id="data_publicacao" value="" />
                                <div class="d-flex">
                                    <div class="d-flex justify-content-center align-items-center width-10">
                                        <i class="fa fa-camera" style="color: white; font-size: 1.5rem" id="capture-image-btn"></i>
                                    </div>
                                    <div class="textarea-box d-flex justify-content-center align-items-center width-80">
                                        <textarea
                                            rows="1"
                                            id="text_message"
                                            placeholder="Envie uma mensagem, audio ou vídeo."></textarea>
                                        <div class="px-4">
                                            <i class="fa fa-paper-plane" aria-hidden="true" id="send-message-btn" style="color: white; font-size: 1.3rem; cursor: pointer;"></i>
                                        </div>
                                    </div>

                                    <div id="microphone-container" class="d-flex justify-content-center align-items-center p-2 width-10">
                                        <i class="fa fa-microphone" aria-hidden="true" id="record-audio-btn" style="display: block; color: #ffffff; font-size: 1.5rem; cursor: pointer"></i>
                                        <span id="record-timer" style="margin-right: 5px; font-size: 1rem; color: #ffffff; display: none;">00:00</span>
                                        <button type="button" class="badge" id="stop-audio-btn" style="display: none;">
                                            &emsp;
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="modal fade" id="camera-modal" tabindex="-1" role="dialog" aria-labelledby="cameraModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cameraModalLabel">Capturar Imagem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <video id="camera-stream" autoplay style="width: 100%; max-height: 400px;"></video>
                        <canvas id="camera-canvas" style="display: none;"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-purple" id="take-photo-btn">📸 Tirar Foto</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<!-- JQuery -->
<script type='text/javascript' src="http://code.jquery.com/jquery-latest.min.js"></script>
<!-- Ajax -->
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!-- Bootstrap 4.1.3 -->
<script type='text/javascript' src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- Toast Mesage -->
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Bootbox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>

<!-- Calendar.io -->
<script src="js/calendario.js"></script>
<script src="js/aside.js"></script>
<script src="js/TextMessage.js"></script>
<script src="js/AudioMessage.js"></script>
<script src="js/ImageMessage.js"></script>

<script src="js/User.js"></script>

</html>