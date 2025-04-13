<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-table"></i> Opções Tabelas Colunas </span>
            </div>
            <div class="col-md-1 p-0">
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="col-md-12 reset">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content bg-white border border-top-0">

                <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fa fa-table"></i> <i><b>Opções Tabelas Colunas</b></i>
                                &emsp;
                                <span id="tab_1_alerts"></span>
                                <img class="loading" src="../img/loading-sm.svg" style="display: none">
                            </div>
                        </div>
                    </div>

                    <form id="tab-1-form-1">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label><i class="fa fa-filter"></i> Tabela </label>
                                    <span style="color: red">*</span>
                                    <select  class="form-control" name="tabela" id="tabela">
                                        <option  value='0'></option>
                                        <!-- <optgroup id="optGroup_tables" label="Tabela"> -->
                                        <optgroup label="Tabela">    
                                            <option value="publicacoes">Publicações</option>
                                        </optgroup>
                                    </select>                        
                                </div>
                            </div> 

                          <!--
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label><i class="fa fa-filter"></i> Tabela </label>
                                    <span style="color: red">*</span>
                                    <select  class="form-control" name="tabela" id="tabela" onchange="optionSelectColunas('tabela', 'coluna')">
                                        <option  value='0'></option>
                                        <optgroup id="optGroup_tables" label="Tabela">

                                        </optgroup>
                                    </select>                        
                                </div>
                            </div> 
                            -->
                   
                            <!--
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Tabela</label>
                                    <select name="tabela" id="tabela" class="form-control">
                                        <option  value='0'></option>
                                        <option value="banner">Banner</option>
                                        <option value="comissoes">Comissoes</option>
                                        <option value="comunicados">Comunicados</option>
                                        <option value="contratos">Contratos</option>
                                        <option value="convenios">Convênios</option>
                                        <option value="entidade">Entidade</option>
                                        <option value="entidade_orgaos">Entidade Órgãos</option>
                                        <option value="diarias">Diárias</option>
                                        <option value="header">Header</option>
                                        <option value="leis">Leis</option>
                                        <option value="logo">Logo</option>
                                        <option value="licitacoes">Licitações</option>
                                        <option value="materias">Matérias</option>
                                        <option value="noticias">Notícias</option>
                                        <option value="obras">Obras</option>
                                        <option value="portarias">Portarias</option>
                                        <option value="processo_seletivo">Processo Seletivo</option>
                                        <option value="publicacoes">Publicações</option>
                                        <option value="responsabilidade">Resp. Fiscal</option>
                                        <option value="servicos">Serviços</option>
                                        <option value="servidor">Servidores</option>
                                        <option value="slide">Slide</option>
                                        <option value="videos">Vídeos</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label><i class="fa fa-filter"></i> Coluna </label>
                                    <span style="color: red">*</span>
                                    <select  class="form-control" name="coluna" id="coluna">
                                        <option  value='0'></option>
                                        <!-- <optgroup id="optGroupcolunas" label="Coluna"> -->
                                        <optgroup label="Coluna">    
                                            <option value="tipo">Tipo</option>
                                        </optgroup>
                                    </select>                        
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome (< option label="" > ) </label><span style="color: red"> *</span>
                                    <input type="text" name="nome" id="nome" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Valor (< option value=""> )</label><span style="color: red"> *</span>
                                    <input type="text" name="valor" id="valor" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome para tag optgroup </label>
                                    <input type="text" name="opcoes_grupo" id="opcoes_grupo" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-1" style="display: flex; align-items: center; padding-top: 15px">
                                <div class="form-check">
                                    <input type="checkbox" name="ativo" class="form-check-input" id="ativo" />
                                    <label>
                                        Ativo
                                    </label>
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
                            <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('tab-1-form-1')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                            <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" style="display: none;" onclick=""><i class="fa fa-floppy-o"></i> Salvar Alterações</button>
                        </div>
                    </div>

                </div>

            </div><!-- tab-content -->
        </div><!-- bgwhite -->
    </section>

</main>