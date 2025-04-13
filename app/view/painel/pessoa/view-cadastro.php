
<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Servidores </span>
            </div>
            <div class="col-md-1 p-0"> 
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div>     
            <div class="col-md-12 reset">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-2">Detalhes</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-user"></i> <i><b>Informações do Servidor</b></i>

                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <svg id="tab_1_loading" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#818182" style="display: none;">
                                        <path d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z">
                                            <animateTransform attributeName="transform" type="rotate" dur="0.75s" values="0 12 12;360 12 12" repeatCount="indefinite" />
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1" >
                            <input type="hidden" name="tbl" id="tbl" value="servidor">

                            <!-- ROW 1 -->
                            <div class="row" id="row-1">
                                <div class="col-md-4">
                                    <div class="form-group input-group-md">
                                        <label>
                                             Nome <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome Completo" required autofocus>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Nome da Mãe
                                        </label>
                                        <input type="text" name="mae" class="form-control" id="mae" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Nome do Pai
                                        </label>
                                        <input type="text" name="pai" class="form-control" id="pai" required>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Data Nascimento
                                        </label>
                                        <input type="date" name="data_nascimento" class="form-control" id="data_nascimento"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label> Naturalidade/UF
                                        </label>
                                        <input type="text" name="naturalidade" class="form-control" id="naturalidade"  placeholder="Cidade" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            CPF
                                        </label>
                                        <input type="text" name="cpf" class="form-control" id="cpf"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label> Titulo de Eleitor
                                        </label>
                                        <input type="text" name="titulo" class="form-control" id="titulo" required value="0">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Zona
                                        </label>
                                        <input type="text" name="zona" class="form-control" id="zona" required value="0">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Sessao
                                        </label>
                                        <input type="text" name="sessao" class="form-control" id="sessao" required value="0">
                                    </div>
                                </div> 


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Escolaridade</label>
                                        <select class="form-control form-control-md" id="escolaridade" name="escolaridade">
                                            <option value="">Escolaridade</option>
                                            <option  value='Fundamental - Incompleto'>Fundamental - Incompleto</option>
                                            <option  value='Fundamental - Completo'>Fundamental - Completo</option>
                                            <option  value='Médio - Incompleto'>Médio - Incompleto</option>
                                            <option  value='Médio - Completo'>Médio - Completo</option>
                                            <option  value='Superior - Incompleto'>Superior - Incompleto</option>
                                            <option  value='Superior - Completo'>Superior - Completo</option>
                                            <option  value='Pós-graduação - Incompleto'>Pós-graduação - Incompleto</option>
                                            <option  value='Pós-graduação - Completo'>Pós-graduação - Completo</option>
                                            <option  value='Pós-graduação - Incompleto'>Pós-graduação - Incompleto</option>
                                            <option  value='Pós-graduação - Completo'>Pós-graduação - Completo</option>
                                            <option  value='Pós-graduação - Incompleto'>Pós-graduação - Incompleto</option>
                                            <option  value='Pós-graduação - Completo'>Pós-graduação - Completo</option>
                                        </select>                        
                                    </div>
                                </div>

                            </div>

                            <!-- ROW 4-->
                            <div class="row" id="row-4">

                                <div class="col-md-4">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Nome Eleitoral<span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="text" name="nome_eleitoral" class="form-control" id="nome_eleitoral"  style="text-transform:uppercase">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Profissao
                                        </label>
                                        <input type="text" name="ocupacao" class="form-control" id="ocupacao">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group input-group-md">
                                        <label><i class="fa fa-filter"></i> Partido</label>
                                        <input type="text" class="form-control" name="partido"  id="partido">
                                    </div>
                                </div>  

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Nº do Gabinete
                                        </label>
                                        <input type="text" name="numero_gabinete" class="form-control" id="numero_gabinete" value="0"> 
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-10">
                                    <!-- ROW 6-->
                                    <div class="row" id="row-6">
                                        <div class="col-md-4">
                                            <div class="form-group input-group-md">
                                                <label><i class="fa fa-home"></i> Endereço</label>
                                                <input type="text" name="endereco" class="form-control" id="endereco">
                                            </div>    
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group input-group-md">
                                                <label>Nº</label>
                                                <input type="text" name="numero" class="form-control" id="numero" value="0">
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group input-group-md">
                                                <label>Bairro</label>
                                                <input type="text" name="bairro" class="form-control" id="bairro">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group input-group-md">
                                                <label>Complemento </label>
                                                <input type="text" name="complemento" class="form-control" id="complemento">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group input-group-md">
                                                <label>cep</label>
                                                <input type="text" name="cep" class="form-control" id="cep">
                                            </div>    
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group input-group-md">
                                                <label>Cidade</label>
                                                <input type="text" name="cidade" class="form-control" id="cidade">
                                            </div>    
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group input-group-md">
                                                <label>UF</label>
                                                <input type="text" name="uf" class="form-control" id="uf">
                                            </div>    
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group input-group-md">
                                                <label>Fone 1</label>
                                                <input type="text" name="fone1" class="form-control" id="fone1">
                                            </div>    
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group input-group-md">
                                                <label>Fone 2</label>
                                                <input type="text" name="fone2" class="form-control" id="fone2">
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group input-group-md">
                                                <label><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
                                                <input type="text" name="email" class="form-control" id="email">
                                            </div>
                                        </div> 

                                        <div class="col-md-4">
                                            <div class="form-group input-group-md">
                                                <label>
                                                    <i class="fa fa-laptop" aria-hidden="true"></i> Web Page
                                                </label>
                                                <input type="text" name="web_page" class="form-control" id="web_page">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group input-group-md">
                                                <label> Senha Votação</label>
                                                <input type="password" name="senha" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-check form-switch">
                                                <label>Ativo/Inativo</label>
                                                <input type="checkbox" id="ativo" name="ativo" >

                                            </div>
                                        </div> 
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img class="img-fluid img-thumbnail" id="imagem_url" src="../../img/cam.jpg" width="170"  onclick="setValueInput2('+ retorno[i].id +')" data-toggle="modal" data-target="#upload-arquivos"">
                                        <span class="btn badge badge-success" id="btn-show-modal-upload" style="width: 93%"><i class="fa fa-camera"></i> Inserir Foto</span>
                                    </div>
                                </div>
                            </div>   

                            <!-- ROW 8-->
                            <div class="row" id="row-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><i class="fa fa-pencil"></i> Biografia</label><br />
                                        <textarea class="form-control" name="bio" id="bio" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <hr>

                        <div class="d-flex justify-content-end align-items-center">
                            <div class="mr-2">
                                <a href="index.php"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</button></a>
                            </div>
                            <div id="botoes-foot">
                                <button type="button" class="btn btn-success  btn-sm"  data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm"  id="tab-1-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA DETALHE  -->
                    <div class="tab-pane" id="tab-2" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-user"></i> -> <i class="fa fa-building-o"></i> <i><b>Vínculo com a Entidade</b></i>
                                </div>
                            </div>
                        </div>

                        <form id="tab-2-form-1" enctype="multipart/form-data">
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1" style="display: none;">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control"  name="id_servidor" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Matricula <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="text" class="form-control" name="matricula" id="matricula" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data de Ingresso <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="date" name="data_ingresso" class="form-control" id="data_ingresso" >
                                    </div>
                                </div>

                                <!--
                                <div class="col-md-3">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Cargo no Órgão
                                        </label>
                                        <input type="text" name="cargo" class="form-control" id="cargo" >
                                    </div>
                                </div> -->

                                <div class="col-md-4">
                                    <div class="form-group input-group-md">
                                        <label><i class="fa fa-filter"></i> Cargo</label>
                                        <select name="id_cargo" id="id_cargo" class="form-control">
                                                <option value='0'></option>
                                                <optgroup id="optGroupcargos" label="Cargos">
    
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                    
                                <div class="col-md-4">
                                    <div class="form-group input-group-md">
                                        <label><i class="fa fa-filter"></i> Órgão</label>
                                        <select  class="form-control" name="id_entidade_orgaos" id="id_entidade_orgaos">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupentidade_orgaos" label="Órgão">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            Expediente Nomeação
                                        </label>
                                        <input type="text" name="numero_expediente_nomeacao" id="numero_expediente_nomeacao" class="form-control" placeholder="Número" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Tipo</label>
                                        <select class="form-control" id="tipo_expediente_nomeacao" name="tipo_expediente_nomeacao">
                                            <option value="">Tipo</option>
                                            <option  value='A'>A - Ato</option>
                                            <option  value='C'>C - Contrato</option>
                                            <option  value='D'>D - Decreto</option>
                                            <option  value='P'>P - Portaria</option>
                                        </select>                        
                                    </div>
                                </div>  

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data Exp. Nomeação 
                                        </label>
                                        <input type="date" name="data_expediente_nomeacao" id="data_expediente_nomeacao" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data de Publicação 
                                        </label>
                                        <input type="date" name="data_publicacao_expediente" id="data_publicacao_expediente" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-md">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data da Posse 
                                        </label>
                                        <input type="date" name="data_posse" id="data_posse" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label>Vínculo Ativo?</label><br/>
                                    <input type="checkbox"  id="vinculo_ativo" name="vinculo_ativo">
                                </div>


                            </div>

                        </form>               

                        <hr/>

                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="thead-pessoa-vinculo">
                                <tr>
                                    <th>Cod</th>
                                    <th>Matricula</th>
                                    <th>Ingresso</th>
                                    <th>Cargo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-pessoa-vinculo">

                            </tbody>
                        </table>
                        <div id="echos-pessoa-vinculo"></div>

                        <hr>
                        <!-- BOTÕES ABA DETALHE -->
                        <div class=" d-flex justify-content-end align-items-center">
                            <div class="mr-2">
                                <a href="index.php">
                                    <button type="button" class="btn btn-secondary btn-sm" id="tab-2-btn-voltar" ><i class="fa fa-undo"></i> Voltar</button>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                            </div>
                            <div id="botoes-foot-tab-2">
                                <button type="button" class="btn btn-success  btn-sm"  id="tab-2-btn-salvar" style="display: block;" onclick="insertPessoaVinculo()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm"  id="tab-2-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div><!-- fim tab-detalge -->
                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>


