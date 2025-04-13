<section
    class="btns-mobile"
    style="
    position: absolute; 
    bottom: 10vh;
    width: 100%;
    padding: 15px 10px">
    <div class="btn-row">
        <button
            type="button"
            class="btn btn-default btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalDetalhes">
            <i class="fa fa-tag mr-2"></i>
            Detalhes
        </button>
        <button
            type="button"
            class="btn btn-success btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalAprovar">
            <i class="fa fa-check mr-2"></i>
            A Favor
        </button>
    </div>
    <div class="btn-row">
        <button
            type="button"
            class="btn btn-danger btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalRejeitar">
            <i class="fa fa-remove mr-2"></i>
            Contra
        </button>
        <button
            type="button"
            class="btn btn-info btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalAbstencao">
            <i class="fa fa-user-secret mr-2"></i>
            Abster-se
        </button>
    </div>
</section>

<section
    class="btns-desktop"
    style="
    position: absolute; 
    bottom: 10vh;
    width: 100%;
    padding: 15px 10px"
>
    <div class="btn-row">
        <button
            type="button"
            class="btn btn-default btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalDetalhes">
            <i class="fa fa-tag mr-2"></i>
            Detalhes
        </button>
        <button
            type="button"
            class="btn btn-success btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalAprovar">
            <i class="fa fa-check mr-2"></i>
            A Favor
        </button>
        <button
            type="button"
            class="btn btn-danger btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalRejeitar">
            <i class="fa fa-remove mr-2"></i>
            Contra
        </button>
        <button
            type="button"
            class="btn btn-info btn-lg btn3d"
            data-bs-toggle="modal"
            data-bs-target="#modalAbstencao">
            <i class="fa fa-user-secret mr-2"></i>
            Abster-se
        </button>
    </div>
</section>

<style>
    .btn-row {
        display: flex;
        justify-content: space-evenly;
        padding: 40px 0px;
    }

    .btn3d {
        font-size: 35px;
        width: 300px;
        height: 100px;

        position: relative;
        top: -6px;
        border: 0;
        transition: all 40ms linear;
    }

    .btns-mobile{
        display: none;
    }
    
    .btn3d:active:focus,
    .btn3d:focus:hover,
    .btn3d:focus {
        -moz-outline-style: none;
        outline: medium none;
    }

    .btn3d:active,
    .btn3d.active {
        top: 2px;
    }

    .btn3d.btn-white {
        color: #666666;
        box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255, 255, 255, 0.10) inset, 0 8px 0 0 #f5f5f5, 0 8px 8px 1px rgba(0, 0, 0, .2);
        background-color: #fff;
    }

    .btn3d.btn-white:active,
    .btn3d.btn-white.active {
        color: #666666;
        box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, .1);
        background-color: #fff;
    }

    .btn3d.btn-default {
        color: #666666;
        box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255, 255, 255, 0.10) inset, 0 8px 0 0 #BEBEBE, 0 8px 8px 1px rgba(0, 0, 0, .2);
        background-color: #f9f9f9;
    }

    .btn3d.btn-default:active,
    .btn3d.btn-default.active {
        color: #666666;
        box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, .1);
        background-color: #f9f9f9;
    }

    .btn3d.btn-primary {
        box-shadow: 0 0 0 1px #417fbd inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #4D5BBE, 0 8px 8px 1px rgba(0, 0, 0, 0.5);
        background-color: #4274D7;
    }

    .btn3d.btn-primary:active,
    .btn3d.btn-primary.active {
        box-shadow: 0 0 0 1px #417fbd inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, 0.3);
        background-color: #4274D7;
    }

    .btn3d.btn-success {
        box-shadow: 0 0 0 1px #31c300 inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #5eb924, 0 8px 8px 1px rgba(0, 0, 0, 0.5);
        background-color: #78d739;
    }

    .btn3d.btn-success:active,
    .btn3d.btn-success.active {
        box-shadow: 0 0 0 1px #30cd00 inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, 0.3);
        background-color: #78d739;
    }

    .btn3d.btn-info {
        box-shadow: 0 0 0 1px #00a5c3 inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #348FD2, 0 8px 8px 1px rgba(0, 0, 0, 0.5);
        background-color: #39B3D7;
    }

    .btn3d.btn-info:active,
    .btn3d.btn-info.active {
        box-shadow: 0 0 0 1px #00a5c3 inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, 0.3);
        background-color: #39B3D7;
    }

    .btn3d.btn-warning {
        box-shadow: 0 0 0 1px #d79a47 inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #D79A34, 0 8px 8px 1px rgba(0, 0, 0, 0.5);
        background-color: #FEAF20;
    }

    .btn3d.btn-warning:active,
    .btn3d.btn-warning.active {
        box-shadow: 0 0 0 1px #d79a47 inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, 0.3);
        background-color: #FEAF20;
    }

    .btn3d.btn-danger {
        box-shadow: 0 0 0 1px #b93802 inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #AA0000, 0 8px 8px 1px rgba(0, 0, 0, 0.5);
        background-color: #D73814;
    }

    .btn3d.btn-danger:active,
    .btn3d.btn-danger.active {
        box-shadow: 0 0 0 1px #b93802 inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, 0.3);
        background-color: #D73814;
    }

    .btn3d.btn-magick {
        color: #fff;
        box-shadow: 0 0 0 1px #9a00cd inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #9823d5, 0 8px 8px 1px rgba(0, 0, 0, 0.5);
        background-color: #bb39d7;
    }

    .btn3d.btn-magick:active,
    .btn3d.btn-magick.active {
        box-shadow: 0 0 0 1px #9a00cd inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, 0.3);
        background-color: #bb39d7;
    }
</style>