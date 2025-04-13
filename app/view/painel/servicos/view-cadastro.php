<main class="col-md-10">

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
        <div class="col-md-11" >
            <span class="span-30" style="color: gray"><i class="fa fa-file-text-o"></i> Serviços </span>
        </div>
        <div class="col-md-1 p-0"> 
            <a href="cadastro.php" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</a>
        </div>
    </div>

    <!-- FORM CADASTRO -->
    <div class="col-md-12  reset">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Cadastro</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content bg-white border border-top-0">

            <div class="tab-pane  active" id="home" style="padding: 20px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-file-text-o"></i> <i><b>Dados do Serviço</b></i>
                            &emsp;
                            <span id="tab_1_alerts"></span>
                            <img class="loading" src="../img/loading-sm.svg" style="display: none">
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1">
                    <div class="bg-white">
                        <input type="hidden" name="tbl" id="tbl" value="servicos">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">	
                                    <label>Titulo do Serviço</label>
                                    <input type="text" class="form-control" name="nome" id="nome" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">	
                                    <label>Resumo do Serviço</label>
                                    <input type="text" class="form-control" name="resumo" id="resumo" />
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Órgão</label>
                                        <select  name="id_entidade_orgaos" id="id_entidade_orgaos" class="form-control">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupentidade_orgaos" label="Órgão">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="categoria" id="categoria" class="form-control">
                                        <optgroup label="Categoria">
                                            <option  value='1'>SERVIÇOS</option><option  value='2'>INSTITUCIONAL</option><option  value='3'>LEI DE ACESSO A INFORMAÇÃO</option><option  value='4'>TRANSPARÊNCIA</option><option  value='5'>LEI DE RESPONSABILIDADE FISCAL</option><option  value='6'>CANAIS DE ATENDIMENTO</option><option  value='7'>MUNICIPAL</option><option  value='8'>COMUNICAÇÃO</option>
                                        </optgroup>
                                    </select>
                                </div>     
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">	
                                    <label>Previsão de prazo para execução</label>
                                    <input type="text" class="form-control" name="prazo" id="prazo" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">	
                                    <label>Horário de atendimento</label>
                                    <input type="text" class="form-control" name="horario" id="horario" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">	
                                    <label>Formas de prestação de serviço</label>
                                    <input type="text" class="form-control" name="execucao_servico" id="execucao_servico" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">	
                                    <label>Custo para o usuário</label>
                                    <input type="text" class="form-control" name="custo" id="custo" value=""  />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">	
                                    <label>Pré requisitos, documentos necessários e principais etapas do serviço</label>
                                    <textarea class="form-control" name="descricao" id="descricao" rows="15" ></textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
                <!-- BOTÕES DA ABA CADASTRO -->
                <hr>
                <div class="d-flex justify-content-end">
                    <div class="d-flex" id="botoes-foot">
                        <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-success  btn-sm mr-2"  data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                        <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Salvar Alterações</button>
                    </div>
                </div>
            </div>

        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br/>
</main> <!-- .col-md-10 -->