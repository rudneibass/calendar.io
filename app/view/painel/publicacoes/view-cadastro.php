<main class="col-md-10">

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
        <div class="col-md-11" >
            <span class="span-30" style="color: gray"><i class="fa fa-file-text-o"></i> Publicações </span>
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
                            <i class="fa fa-file-text-o"></i> <i><b>Dados da Publicação</b></i>
                            &emsp;
                            <span id="tab_1_alerts"></span>
                            <img class="loading" src="../img/loading-sm.svg" style="display: none">
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1">
                    <div>
                        <input type="hidden" value="publicacoes" name="tbl" id="tbl">	
                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Tipo</label>	
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value=''><span class='txtselect'></span></option>
                                        <optgroup label="Tipo de Publicação" id="optgroup_tipo">

                                        </optgroup>
                                        <!--<optgroup label="Concurso Público" id="optgroup_tipo">
                                            <option  value='Edital de concurso público'>Edital de concurso público</option>
                                            <option  value='Homologação das inscrições para candidatos com deficiência'>Homologação das inscrições para candidatos com deficiência</option>
                                            <option  value='Locais de provas'>Locais de provas</option>
                                            <option  value='Gabarito preliminar'>Gabarito preliminar</option>
                                            <option  value='Recurso prova objetiva'>Recurso prova objetiva</option>
                                            <option  value='Comunicado de resultado dos recursos'>Comunicado de resultado dos recursos</option> 
                                        </optgroup>
                                        <optgroup label="Legislativo">
                                            <option  value='Lei Orgânica'>Lei Orgânica</option>
                                            <option  value='Regimento Interno'>Regimento Interno</option>
                                            <option  value='Portarias'>Portarias</option>
                                            <option  value='Ofícios Recebidos'>Ofícios Recebidos</option>
                                            <option  value='Homologação de Isenções'>Homologação de Isenções</option>
                                        </optgroup>
                                        <optgroup label="Licitações">
                                            <option  value='Edital'>Edital</option>
                                            <option  value='Aditivos'>Aditivos</option>
                                            <option  value='Concorrência'>Concorrência</option>
                                            <option  value='Dispensa de Licitação'>Dispensa de Licitação</option>
                                        </optgroup>
                                        <optgroup label="Periódicos">
                                            <option  value='Diário Oficial'>Diário Oficial</option>
                                        </optgroup> -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Órgão </label>
                                    <select  class="form-control" name="id_entidade_orgaos" id="id_entidade_orgaos">
                                        <option  value='0'></option>
                                        <optgroup id="optGroupentidade_orgaos" label="Órgão">

                                        </optgroup>
                                    </select>                        
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Gestão/Legislatura</label>
                                    <select  class="form-control" name="id_mandatos" id="id_mandatos">
                                        <option  value='0'></option>
                                        <optgroup id="optGroupmandatos" label="Gestão/Legislatura">

                                        </optgroup>
                                    </select>                        
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Número</label>	
                                    <input type="text" name="numero" class="form-control" placeholder="Número" id="numero" value="" />
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">	
                                    <label>Exercício</label>
                                    <input type="text" name=exercicio class="form-control" id="exercicio" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Competência</label>				
                                    <select name="competencia" id="competencia"  class="form-control" >
                                        <option id='txtselect' value=''>Competência</option><option  value='1'>Janeiro</option><option  value='2'>Fevereiro</option><option  value='3'>Março</option><option  value='4'>Abril</option><option  value='5'>Maio</option><option  value='6'>Junho</option><option  value='7'>Julho</option><option  value='8'>Agosto</option><option  value='9'>Setembro</option><option  value='10'>Outubro</option><option  value='11'>Novembro</option><option  value='12'>Dezembro</option><option  value='13'>1º Bimestre</option><option  value='14'>2º Bimestre</option><option  value='15'>3º Bimestre</option><option  value='16'>4º Bimestre</option><option  value='17'>5º Bimestre</option><option  value='18'>6º Bimestre</option><option  value='19'>1° Quadrimestre</option><option  value='20'>2° Quadrimestre</option><option  value='21'>3° Quadrimestre</option><option  value='22'>1° Semestre</option><option  value='23'>2° Semestre</option><option  value='24'>Anual</option>                                                    </select>			
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-calendar"></i> Data</label>	
                                    <input type="date" name="data_publicacao" class="form-control" id="data_publicacao" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">	
                                    <label> Titulo</label>
                                    <input type="text" name="titulo" class="form-control" id="titulo" value=""  />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">	
                                    <label> Descrição</label>
                                    <textarea  name="descricao" class="form-control" id="descricao" value="" rows="4"></textarea>
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

            <!-- ABA ARQUIVOS -->
            <div class="tab-pane fade" id="tab-2" style="padding: 20px;">
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-file-text-o"></i> <i><b>Arquivos da Publicação</b></i>
                        </div>
                    </div>
                </div>                
                
                <form id="search-arquivos">
                    <input type="hidden" name="id_tabela_pai"  id="id-tabela-pai-form-search-arquivos" value="">

                    <div class="row" id="row-1">
                        <div class="col-md-5">
                            <div class="input-group  input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                </div>
                                <input type="text" name="c1"  id="c1" class="form-control" placeholder="Nome">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group  input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                </div>
                                <input type="date" name="c2"  id="c2" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group  input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                </div>
                                <input type="date" name="c3"  id="c3" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="input-group  input-group-sm mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" id="pesquisar-arquivos" >
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
                <hr/>
                <div class="d-flex justify-content-end">
                    <div class="d-flex" id="botoes-foot-tab-2">
                        <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-2-btn-voltar"><i class="fa fa-undo"></i> Voltar</button></a>
                        <button type="button" class="btn btn-sm btn-info" id="tab-2-btn-show-modal-upload"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button> 
                    </div>
                </div>

            </div><!-- FIM DA ABA ARQUIVOS -->
        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br/>
</main> <!-- .col-md-10 -->