<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-file-text"></i> Licitações </span>
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
            <div class="col-md-12  reset">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-2">Fases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-4">Arquivos</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px; ">
  
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text-o"></i><i><b> Dados da Licitação</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1">
                            <div>
                                <input type="hidden" value="licitacoes" name="tbl" id="tbl">

                                <div class="row" id="row-1">

                                    <div class="col-md-12 mb-4">                                    
                                        <fieldset class="border p-3">
                                            <legend class="w-auto" style="padding: 0 10px; border-bottom: none; font-size: 1.1rem">Dados básicos</legend>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-filter"></i> Órgãos <span id="asterisco" style="color:#F00">*</span></label>
                                                        <select name="id_entidade_orgaos" id="id_entidade_orgaos" class="form-control">
                                                            <option value='0'></option>
                                                            <optgroup id="optGroupentidade_orgaos" label="Órgão">

                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-filter"></i> Gestão/Legislatura <span id="asterisco" style="color:#F00">*</span></label>
                                                        <select class="form-control" name="id_mandatos" id="id_mandatos">
                                                            <option value='0'></option>
                                                            <optgroup id="optGroupmandatos" label="Mandato/Gestão">

                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>
                                                            Exercício<span id="asterisco" style="color:#F00">*</span>
                                                        </label>
                                                        <input type="text" name="exercicio" id="exercicio" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>
                                                            Processo<span id="asterisco" style="color:#F00">*</span>
                                                        </label>
                                                        <input type="text" name="processo" id="processo" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-filter"></i>Modalidade </label>
                                                        <select name="modalidade" id="modalidade" class="form-control">
                                                            <option value="">Selecione uma modalidade</option>
                                                            <option value='Chamamento Público'>Chamamento Público</option>
                                                            <option value='Concorrência'>Concorrência</option>
                                                            <option value='Concurso'>Concurso</option>
                                                            <option value='Convite'>Convite</option>
                                                            <option value='Dispensa'>Dispensa</option>
                                                            <option value='Inexigibilidade'>Inexigibilidade</option>
                                                            <option value='Leilão'>Leilão</option>
                                                            <option value='Pregão'>Pregão</option>
                                                            <option value='Tomada de preços'>Tomada de preços</option>
                                                            <option value='Outras Modalidades'>Outras Modalidades</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-filter"></i>Tipo </label>
                                                        <select name="tipo" id="tipo" class="form-control">
                                                            <option value="">Selecione um tipo</option>
                                                            <option value='Menor Preço'>Menor Preço</option>
                                                            <option value='Melhor Técnica'>Melhor Técnica</option>
                                                            <option value='Melhor Técnica e Preço'>Melhor Técnica e Preço</option>
                                                            <option value='Outros Tipos'>Outros Tipos</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>
                                                            Data de Publicação do Aviso
                                                        </label>
                                                        <input type="date" name="data_publicacao_aviso" id="data_publicacao_aviso" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>
                                                            Data de Publicação do Edital
                                                        </label>
                                                        <input type="date" name="data_publicacao_edital" id="data_publicacao_edital" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-filter"></i> Situação atual </label>
                                                        <select name="situacao" id="situacao" class="form-control">
                                                            <option value="">Situação</option>
                                                            <option value="Em fase interna">Em fase interna</option>
                                                            <option value="Publicada">Publicada</option>
                                                            <option value="Aberta">Aberta</option>
                                                            <option value="Encerrada para propostas">Encerrada para propostas</option>
                                                            <option value="Em análise">Em análise</option>
                                                            <option value="Habilitada">Habilitada</option>
                                                            <option value="Inabilitada">Inabilitada</option>
                                                            <option value="Classificada">Classificada</option>
                                                            <option value="Desclassificada">Desclassificada</option>
                                                            <option value="Em julgamento">Em julgamento</option>
                                                            <option value="Homologada">Homologada</option>
                                                            <option value="Adjudicada">Adjudicada</option>
                                                            <option value="Contratada">Contratada</option>
                                                            <option value="Em execução">Em execução</option>
                                                            <option value="Concluída">Concluída</option>
                                                            <option value="Suspensa">Suspensa</option>
                                                            <option value="Revogada">Revogada</option>
                                                            <option value="Anulada">Anulada</option>
                                                            <option value="Fracassada">Fracassada</option>
                                                            <option value="Deserta">Deserta</option>
                                                            <option value="Cancelada">Cancelada</option>
                                                            <option value="Rescindida">Rescindida</option>
                                                            <option value="Em recurso">Em recurso</option>
                                                            <option value="Em diligência">Em diligência</option>
                                                            <option value="Suplente">Suplente</option>
                                                            <option value="Titular">Titular</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-12 mb-4">                                    
                                        <fieldset class="border p-3">
                                            <legend class="w-auto" style="padding: 0 10px; border-bottom: none; font-size: 1.1rem">Informações da sessão pública de abertura das propostas</legend>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="local_abertura">
                                                            Local da sessão pública de abertura das propostas
                                                        </label>
                                                        <input type="text" name="local_abertura" id="local_abertura" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="data_abertura">Data de abertura</label>
                                                        <input type="date" name="data_abertura" id="data_abertura" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="hora_abertura">Hora  de abertura</label>
                                                        <input type="text" name="hora_abertura" id="hora_abertura" class="form-control" placeholder="00:00" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-12 mb-4">                                    
                                        <fieldset class="border p-3">
                                            <legend class="w-auto" style="padding: 0 10px; border-bottom: none; font-size: 1.1rem">Publicação</legend>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>
                                                            Formas de Publicação
                                                        </label>
                                                        <input type="text" name="formas_publicacao" id="formas_publicacao" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-filter"></i> Publicar agora no site? </label>
                                                        <select name="ativo" id="ativo" class="form-control">
                                                            <option value="N">Não</option>
                                                            <option value="S">Sim</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-center">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="contra_covid" id="contra_covid" class="form-check-input" required>
                                                        <label class="form-check-label">
                                                            Contra Covid-19
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-12 mb-4">                                    
                                        <fieldset class="border p-3">
                                            <legend class="w-auto" style="padding: 0 10px; border-bottom: none; font-size: 1.1rem">Responsáveis</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Pregoeiro/Presidente da Comissão
                                                        </label>
                                                        <input type="text" name="pregoeiro_presidente" id="pregoeiro_presidente" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Responsável pela Informação
                                                        </label>
                                                        <input type="text" name="resp_informacao" id="resp_informacao" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Responsável pelo Parecer Técnico Jurídico
                                                        </label>
                                                        <input type="text" name="resp_parecer_juridico" id="resp_parecer_juridico" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Responsável pela Adjudicação
                                                        </label>
                                                        <input type="text" name="resp_adjudicacao" id="resp_adjudicacao" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Responsável pela Homologação
                                                        </label>
                                                        <input type="text" name="resp_homologacao" id="resp_homologacao" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-12 mb-4">                                    
                                        <fieldset class="border p-3">
                                            <legend class="w-auto" style="padding: 0 10px; border-bottom: none; font-size: 1.1rem">Objeto da Licitação<span id="asterisco" style="color:#F00">*</span></legend>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <textarea name="objeto_licitacao" id="objeto_licitacao" class="form-control" rows="5" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                </div><!-- row-1 -->

                            </div>
                            <br />
                        </form>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-success  btn-sm mr-2" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA FASES  -->
                    <div class="tab-pane fade" id="tab-2" style="padding: 20px;">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text-o"></i><i><b> Fases da Licitação</b></i>
                                </div>
                            </div>
                        </div>

                        <form id="tab-2-form-1">
                            <input type="hidden" value="licitacoes_fases" name="tbl" id="tbl">
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control" name="id_licitacoes" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Fase</label>
                                        <select class="form-control" name="fase" id="fase">
                                            <option value='0'></option>

                                            <!-- Fase Interna (Preparatória) -->
                                            <optgroup label="Fase Interna (Preparatória)">
                                                <option value='Definição do objeto'>Definição do Objeto</option>
                                                <option value='Estudo técnico preliminar e estimativa de custos'>Estudo Técnico Preliminar e Estimativa de Custos</option>
                                                <option value='Escolha da modalidade e critérios de julgamento'>Escolha da Modalidade e Critérios de Julgamento</option>
                                                <option value='Elaboração do edital e documentos técnicos'>Elaboração do Edital e Documentos Técnicos</option>
                                                <option value='Publicação do aviso de licitação'>Publicação do Aviso de Licitação</option>
                                            </optgroup>

                                            <!-- Fase Externa (Execução da Licitação) -->
                                            <optgroup label="Fase Externa (Execução da Licitação)">
                                                <option value='Abertura'>Abertura - Recebimento dos Documentos e Propostas</option>
                                                <option value='Habilitação'>Habilitação - Análise da Regularidade Jurídica, Fiscal e Trabalhista</option>
                                                <option value='Julgamento das propostas'>Julgamento das Propostas</option>
                                                <option value='Recursos administrativos'>Recursos Administrativos</option>
                                                <option value='Homologação'>Homologação</option>
                                            </optgroup>

                                            <!-- Fase de Contratação e Execução -->
                                            <optgroup label="Fase de Contratação e Execução">
                                                <option value='Adjudicação'>Adjudicação</option>
                                                <option value='Assinatura do contrato'>Assinatura do Contrato</option>
                                                <option value='Execução contratual'>Execução Contratual</option>
                                                <option value='Fiscalização'>Fiscalização</option>
                                                <option value='Encerramento'>Encerramento</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data 
                                        </label>
                                        <input type="date" class="form-control" name="data_fase" id="data_fase">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>
                                            Hora 
                                        </label>
                                        <input type="text" class="form-control" name="hora_fase" id="hora_fase">
                                    </div>
                                </div>


                            </div>

                        </form>

                        <hr />

                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="tab-2-thead-1">
                                <tr>
                                    <th>Cod</th>
                                    <th>FASE</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tab-2-tbody-1">

                            </tbody>
                        </table>
                        <div id="tab-2-echos-1"></div>

                        <hr>
                        <!-- BOTÕES ABA DETALHE -->
                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot-tab-2">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-danger btn-sm mr-2" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm" id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-2-btn-salvar-alteracoes" style="display: none;" onclick=""><i class="fa fa-floppy-o"></i> Salvar Alterações</button>
                            </div>
                        </div>
                    </div><!-- fim tab-2 -->





                    <!-- ABA ARQUIVOS  -->
                    <div class="tab-pane fade" id="tab-4" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text-o"></i><i><b> Arquivos da Licitação</b></i>
                                </div>
                            </div>
                        </div>

                        <form id="search-arquivos">
                            <input type="hidden" name="id_tabela_pai" id="id-tabela-pai-form-search-arquivos" value="">

                            <div class="row" id="row-1">
                                <div class="col-md-5">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c1" id="c1" class="form-control" placeholder="Nome">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c2" id="c2" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c3" id="c3" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="input-group  input-group-sm mb-3">
                                        <button type="button" class="btn btn-secondary btn-sm" id="pesquisar-arquivos">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <table class="table table-hover table-bordered table-striped">
                            <thead id='thead-arquivos'>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id='tbody-arquivos'>

                            </tbody>
                        </table>
                        <div id="echos-arquivos"></div>
                        <hr />
                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot-tab-2">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-4-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-sm btn-info" id="tab-4-btn-show-modal-upload"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button>
                            </div>
                        </div>

                    </div><!-- fim tab-3 -->


                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>