<main class="col-md-10">
    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-file-text"></i> Responsabilidade Fiscal </span>
            </div>
            <div class="col-md-1 p-0">
                <a href="cadastro.php" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</a>
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
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-2">Arquivos</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content bg-white border border-top-0">

                <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fa fa-file-text"></i> <i><b>Resp. Fiscal</b> &nbsp;<img class="loading"src="../img/loading-sm.svg" style="display: none"></i>
                            </div>
                        </div>
                    </div>

                    <form id="tab-1-form-1">
                        <input type="hidden" value="responsabilidade" name="tbl" id="tbl">

                        <div class="row" id="row-1">

                            <div class="col-md-6">
                                <div class="form-group input-group-md mb-2">
                                    <label class="mb-0">
                                        Descricao<span id="asterisco" style="color:#F00">*</span>
                                    </label>
                                    <input type="text" name="descricao" id="descricao" class="form-control" required>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group input-group-md mb-2">
                                    <label class="mb-0">
                                        Data de Publicação<span id="asterisco" style="color:#F00">*</span>
                                    </label>
                                    <input type="date" name="data_publicacao" id="data_publicacao" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group input-group-md mb-2">
                                    <label class="mb-0"><i class="fa fa-filter"></i> Tipo LRF</label>
                                    <select id="tipo_lrf" name="tipo_lrf" class="form-control">
                                        <option value="0"></option>
                                        <option value="01-BF - Balanço Financeiro"> BF - Balanço Financeiro</option>
                                        <option value="02-CDM - Cronograma de Desembolso"> CDM - Cronograma de Desembolso</option>
                                        <option value="03-LDO - Lei de Diretrizes Orçamentarias"> LDO - Lei de Diretrizes Orçamentarias</option>
                                        <option value="04-LOA - Lei Orçamentaria Anual"> LOA - Lei Orçamentaria Anual</option>
                                        <option value="05-OCA - Orçamento da Criança e do Adolescente"> OCA - Orçamento da Criança e do Adolescente</option>
                                        <option value="06-OPC - Oficio de Prestação de Contas"> OPC - Oficio de Prestação de Contas</option>
                                        <option value="07-PCAP - Prestação de Contas Anual e Parecer"> PCAP - Prestação de Contas Anual e Parecer</option>
                                        <option value="08-PCS - Prestação de Contas de Gestão"> PCS - Prestação de Contas de Gestão</option>
                                        <option value="09-PCG - Prestação de Contas de Governo"> PCG - Prestação de Contas de Gestão</option>
                                        <option value="10-PFA - Programação Financeira"> PFA - Programação Financeira</option>
                                        <option value="11-PPA - Plano Plurianual"> PPA - Plano Plurianual</option>
                                        <option value="12-PRGFIN - Programação Financeira e CEMED - Conograma da Execução Mensal de Desembolso"> PRGFIN - Programação Financeira e CEMED - Conograma da Execução Mensal de Desembolso</option>
                                        <option value="13-PROCEDIMENTOS CONTABÉIS PATRIMONIAIS E ESPECÍFICOS E O CRONOGRAMA DE AÇÕES"> PROCEDIMENTOS CONTABÉIS PATRIMONIAIS E ESPECÍFICOS E O CRONOGRAMA DE AÇÕES</option>
                                        <option value="14-QDB - Quadro de Detalhamento de Despesas"> QDB - Quadro de Detalhamento de Despesas</option>
                                        <option value="15-QDD - Quadro de Detalhamento das Despesas">QDD - Quadro de Detalhamento das Despesas</option>
                                        <option value="16-RCI - Relatório de Controle Interno"> RCI - Relatório de Controle Interno</option>
                                        <option value="17-RGF - Relatório de Gestão Fiscal"> RGF - Relatório de Gestão Fiscal</option>
                                        <option value="18-RREO - Relatório Resumido da Execução Orçamentaria">RREO - Relatório Resumido da Execução Orçamentaria</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group input-group-md mb-2">
                                    <label class="mb-0"><i class="fa fa-filter"></i> Tipo Período</label>
                                    <select id="tipo_periodo" name="tipo_periodo" class="form-control">
                                        <option value="0"></option>
                                        <option value='Anual'>Anual</option>
                                        <option value='Bimestral'>Bimestral</option>
                                        <option value='Trimestral'>Trimestral</option>
                                        <option value='Quadrimestral'>Quadrimestral</option>
                                        <option value='Semestral'>Semestral</option>
                                        <option value='Anual'>Anual</option>
                                        <option value='Trienal'>Trienal</option>
                                        <option value='Quadrienal'>Quadrienal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" id="select">
                                <div class="form-group input-group-md mb-2">
                                    <label class="mb-0"><i class="fa fa-filter"></i> Período</label>
                                    <select id="periodo" name="periodo" class="form-control">
                                        <option value="0"></option>
                                        <optgroup id='anual' label="Anual">
                                            <option id='anual' value="Anual">Anual</option>
                                        </optgroup>
                                        <optgroup id='bimestral' label="Bimestral">
                                            <option value="1º Bimestre">1º Bimestre</option>
                                            <option value='2º Bimestre'>2º Bimestre</option>
                                            <option value='3º Bimestre'>3º Bimestre</option>
                                            <option value='4º Bimestre'>4º Bimestre</option>
                                            <option value='5º Bimestre'>5º Bimestre</option>
                                            <option value='6º Bimestre'>6º Bimestre</option>
                                        </optgroup>
                                        <optgroup id='trimestral' label="Timestral">
                                            <option id='trimestral' value="1º Trimestre">1º Trimestre</option>
                                            <option id='trimestral' value='2º Trimestre'>2º Trimestre</option>
                                            <option id='trimestral' value='3º Trimestre'>3º Trimestre</option>
                                            <option id='trimestral' value='4º Trimestre'>4º Trimestre</option>
                                        </optgroup>
                                        <optgroup id='quadrimestral' label="Quadrimestral">
                                            <option id='quadrimestral' value="1º Quadrimestre">1º Quadrimestre</option>
                                            <option id='quadrimestral' value='2º Quadrimestre'>2º Quadrimestre</option>
                                            <option id='quadrimestral' value='3º Quadrimestre'>3º Quadrimestre</option>
                                        </optgroup>
                                        <optgroup id='semestral' label="Semestral">
                                            <option id='semestral' value="1º Semestre">1º Semestre</option>
                                            <option id='semestral' value='2º Semestre'>2º Semestre</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2" id="exerc">
                                <div class="form-group input-group-md mb-2">
                                    <label class="mb-0">
                                        Exercício<span id="asterisco" style="color:#F00">*</span>
                                    </label>
                                    <input type="text" name="exercicio" id="exercicio" class="form-control">
                                </div>
                            </div>

                        </div><!-- row-1 -->

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

                </div><!-- tab-1-->

                <div class="tab-pane" id="tab-2" style="padding: 20px;">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fa fa-file-text"></i> <i><b>Arquivos</b></i>
                            </div>
                        </div>
                    </div>

                    <form id="search-arquivos">
                        <input type="hidden" name="id_tabela_pai" id="id-tabela-pai-form-search-arquivos" value="">

                        <div class="row" id="row-1">
                            <div class="col-md-5">
                                <div class="input-group  input-group-md mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                    </div>
                                    <input type="text" name="c1" id="c1" class="form-control" placeholder="Nome">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group  input-group-md mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                    </div>
                                    <input type="date" name="c2" id="c2" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group  input-group-md mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                    </div>
                                    <input type="date" name="c3" id="c3" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="input-group  input-group-md mb-2">
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

                    <div class="d-flex justify-content-between">
                        <div id="btn-upload">

                        </div>

                        <div class="d-flex" id="botoes-foot-tab-2">
                            <a class="btn btn-secondary btn-sm mr-2" href="index.php"><i class="fa fa-undo"></i> Voltar</a>
                            <button type="button" class="btn btn-sm btn-info" id="tab-2-btn-show-modal-upload"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button>
                        </div>
                    </div>

                </div><!-- tab-2 -->


            </div><!-- tab-content -->
        </div><!-- bgwhite -->

    </section>





</main> <!-- .col-md-10 -->