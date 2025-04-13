<main class="col-md-10">

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
        <div class="col-md-11" >
            <span class="span-30" style="color: gray"><i class="fa fa-film"></i> Vídeos </span>
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
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#integracoes">Integrações</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content bg-white border border-top-0">

            <div class="tab-pane active" id="home" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-file-text-o"></i> <i><b>Dados do Vídeo  </b></i>
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1">
                    <input type="hidden" value="videos" name="tbl" id="tbl">	

                    <div class="row" id="row-1">
                        <div class="col-md-3">
                            <div class="form-group input-group-md mb-1">
                                <label>Data do Vídeo</label><span id="asterisco" style="color:#F00">*</span> 
                                <input type="date" name="data_video" id="data_video"  class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group input-group-md mb-1">
                                <label><i class="fa fa-filter"></i> Órgão</label>
                                <select  name="id_entidade_orgaos" id="id_entidade_orgaos" class="form-control">
                                    <option  value='0'></option>
                                    <optgroup id="optGroupentidade_orgaos" label="Órgão">

                                    </optgroup>
                                </select>                        
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group input-group-md mb-1">
                                <label><i class="fa fa-filter"></i> Mandato/Gestão</label>
                                <select  name="id_mandatos" id="id_mandatos" class="form-control">
                                    <option  value='0'></option>
                                    <optgroup id="optGroupmandatos" label="Mandato/Gestão">

                                    </optgroup>
                                </select>                        
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group input-group-md mb-1">
                                <label><i class="fa fa-filter"></i> Categoria</label>
                                <select id="categoria" name="categoria" class="form-control">
                                    <option value="">Categoria</option>
                                    <option  value='1'>#Administração      </option><option  value='2'>#Agenda             </option><option  value='3'>#Agricultura        </option><option  value='91'>#Aluguéis</option><option  value='86'>#ApoioAoPaciente</option><option  value='4'>#AssistênciaSocial  </option><option  value='5'>#Audiência          </option><option  value='93'>#Certidões</option><option  value='85'>#ConselhoTutelar </option><option  value='6'>#Controladoria      </option><option  value='7'>#Controle           </option><option  value='8'>#Cultura            </option><option  value='9'>#DefesaCivil        </option><option  value='10'>#Desenvolvimento    </option><option  value='11'>#DireitosHumano     </option><option  value='12'>#Drogas             </option><option  value='13'>#Educação           </option><option  value='14'>#Empreendedorismo   </option><option  value='15'>#Emprego            </option><option  value='92'>#Endereço</option><option  value='16'>#Esporte            </option><option  value='17'>#Festa              </option><option  value='18'>#Finança            </option><option  value='19'>#FolhaDePagamento   </option><option  value='20'>#Gestão             </option><option  value='21'>#Habitação          </option><option  value='95'>#Imóveis </option><option  value='22'>#Imposto            </option><option  value='23'>#Infraestrutura     </option><option  value='94'>#Isenção </option><option  value='24'>#Jurídico           </option><option  value='25'>#Juventude          </option><option  value='26'>#Lazer              </option><option  value='27'>#Limpeza            </option><option  value='28'>#MeioAmbiente       </option><option  value='29'>#Melhoria           </option><option  value='30'>#Mobilidade         </option><option  value='31'>#Mulher             </option><option  value='32'>#Município          </option><option  value='87'>#nataldeamordeluz</option><option  value='33'>#Obra               </option><option  value='34'>#Planejamento       </option><option  value='35'>#Prefeito           </option><option  value='88'>#Saneamento</option><option  value='36'>#Saúde              </option><option  value='37'>#Segurança          </option><option  value='38'>#Tecnologia         </option><option  value='39'>#Transparência      </option><option  value='89'>#Tributação </option><option  value='40'>#Tributo            </option><option  value='90'>#Tributos</option><option  value='41'>#Turismo            </option><option  value='42'>#Urbanismo          </option>

                                </select>                        
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12 reset">
                                <label>Título</label>
                                <div class="form-group">
                                    <textarea name="nome" id="nome"  class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 reset">
                                <label>Descrição</label>
                                <div class="form-group">
                                    <textarea name="descricao" id="descricao"  class="form-control" rows="5"></textarea>
                                </div>
                            </div>        
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                Incorporar <i>(Código iframe para incorporar o vídeo)</i>
                                <!-- <input type="text" name="url" id="url"  class="form-control" required> -->
                                <textarea name="url" id="url"  class="form-control" rows="10"></textarea>
                            </div>
                        </div>

                    </div><!-- row-1 -->
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

            <div class="tab-pane" id="integracoes" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-file-text-o"></i> <i><b>Integração</b></i>
                        </div>
                    </div>
                </div>

                <form id="tab-2-form-1" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 mb-4">                                    
                            <fieldset class="border p-3">
                                <legend class="w-auto" style="padding: 0 10px; border-bottom: none; font-size: 1.1rem">YouTube</legend>                  
                                <div class="row">     
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label><i class="fa fa-filter"></i> Plataforma</label>
                                            <select class="form-control" id="platform" name="platform">
                                                <option value="youtube">YouTube</option>
                                            </select>                        
                                        </div>
                                    </div>  
                                    <div class="col-md-10">
                                        <div class="form-group input-group-md">
                                            <label>
                                                Url da api (Api url)
                                            </label>
                                            <input type="text" name="api_url" id="api_url" class="form-control" placeholder="Url da api de integração" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group input-group-md">
                                            <label>
                                                Chave da api (Api key)
                                            </label>
                                            <input type="text" name="api_key" id="api_key" class="form-control" placeholder="Api key" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group input-group-md">
                                            <label>
                                                Id do canal (Channel id)
                                            </label>
                                            <input type="text" name="channel_id" id="channel_id" class="form-control" placeholder="Channel id" >
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>    
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="thead-videos-integracoes">
                            </thead>
                            <tbody id="tbody-videos-integracoes">
                            </tbody>
                        </table>
                        <div id="tb-2-alerts"></div>
                    </div>
                </div> 
                <hr/>
                <div class="d-flex justify-content-end">
                    <a href="index.php" class="btn btn-secondary btn-sm ml-2"><i class="fa fa-undo"></i> Voltar</a>
                    <button type="button" class="btn btn-success  btn-sm ml-2"  id="tab-2-btn-salvar" onclick="insertTab2Form1()" style="display: block;">
                        &emsp;&emsp;
                        <i class="fa fa-floppy-o"></i> 
                        Salvar
                        &emsp;&emsp;
                    </button>
                    <button type="button" class="btn btn-info btn-sm ml-2" id="tab-2-btn-salvar-alteracoes" onclick="" style="display: none">
                        <i class="fa fa-floppy-o" aria-hidden="true" ></i> 
                        Salvar Alterações
                    </button>
                </div>
            </div>

        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br/>
</main> <!-- .col-md-10 -->