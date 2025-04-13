
<main class="col-md-10">

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
        <div class="col-md-11" >
            <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Usuários </span>
        </div>
        <div class="col-md-1 p-0"> 
            <a href="cadastro.php">
                <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
            </a>
        </div>
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Cadastro</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content bg-white border border-top-0">

        <div class="tab-pane active" id="home" style="padding: 20px;">
             
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-light border" role="alert">
                        <i class="fa fa-users"></i> <i><b>Dados do Usuário</b></i>
                    </div>
                </div>
            </div>

            <form id="form_insert">
                <input type="hidden" value="usuarios" name="tbl" id="tbl">	

                <!-- ROW 1 -->

                <div class="row" id="row-1">

                    <div class="col-md-3">
                        <div class="form-group input-group-sm mb-3">
                            <label>
                                <i class="fa fa-user"></i> Nome <span id="asterisco" style="color:#F00">*</span> 
                            </label>
                            <input type="text" name="nome" class="form-control" id="nome" required style="text-transform:uppercase">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group input-group-sm mb-3">
                            <label>
                                login<span id="asterisco" style="color:#F00">*</span> 
                            </label>
                            <input type="text" name="login" class="form-control" id="login"  required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group input-group-sm mb-3">
                            <label>
                                Senha
                            </label>
                            <input type="password" name="senha" class="form-control" id="_senha"  required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group input-group-sm mb-3">
                            <label>
                                Confirmar Senha
                            </label>
                            <input type="password" name="confirma_senha" class="form-control" id="conf_senha"  required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group input-group-sm mb-3">
                            <label>
                                Email
                            </label>
                            <input type="text" name="email" class="form-control" id="email" required>
                        </div>
                    </div>                

                    <div class="col-md-1">
                        <div class="form-group input-group-sm mb-3">
                            <label>Tipo</label><br/>
                            <select id="tipo" name="tipo">
                                <option value=""></option>
                                <option  value='1'>Adm</option>
                                <option  value='2'>Editor</option>
                                <option  value='3'>Fical</option>
                            </select>                        
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group input-group-sm mb-3">
                            <label>Ativo?</label><br/>
                            <select id="ativo" name="ativo">
                                <option value=""></option>
                                <option  value='1'>Sim</option>
                                <option  value='0'>Nao</option>
                            </select>                        
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group input-group-sm mb-3">
                            <label>Código de Segurança </label> 
                            <input type="text" name="captcha" class="form-control" placeholder="Digite aqui o código de segurança" required>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group input-group-sm mb-3">
                            <img src="../captcha/captcha.php" alt="Código Captcha" class="img-thumbnail mt-3">
                        </div>
                    </div>
                    
                </div>

            </form>

            <hr>
            <div class="d-flex justify-content-end">
                <div class="d-flex" id="botoes-foot">
                    <a href="../usuarios" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                    <button type="button" class="btn btn-success  btn-sm"  data-dismiss="modal" id="btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                </div>

            </div>
        </div>

    </div>
</main>


