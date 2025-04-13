
<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"><i class="fa fa-map"></i> Município </span>
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
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-balance-scale"></i> <i><b>Dados do Município</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">                                      
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1" enctype="multipart/form-data">
                            <div>
                    
                                <div class="row"> 
                                    
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>
                                                Nome 
                                            </label>
                                            <input type="text" name="nome" id="nome" class="form-control"   required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Data de Fundação 
                                            </label>
                                            <input type="date" name="data_fundacao" id="data_fundacao" class="form-control"   required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Data de Emancipação 
                                            </label>
                                            <input type="date" name="data_emancipacao" id="data_emancipacap" class="form-control"   required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Gentílico 
                                            </label>
                                            <input type="text" name="gentilico" id="gentilico" class="form-control"   required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Unidade Federativa </label>
                                            <select name="unidade_federativa" id="unidade_federativa" class="form-control">
                                                <option value=""></option>
                                                <option value="AC">AC - Acre</option>
                                                <option value="AL">AL - Alagoas</option>
                                                <option value="AP">AP - Amapá</option>
                                                <option value="AM">AM - Amazonas</option>
                                                <option value="BA">BA - Bahia</option>
                                                <option value="CE">CE - Ceará</option>
                                                <option value="DF">DF - Distrito Federal</option>
                                                <option value="ES">ES - Espírito Santo</option>
                                                <option value="GO">GO - Goiás</option>
                                                <option value="MA">MA - Maranhão</option>
                                                <option value="MT">MT - Mato Grosso</option>
                                                <option value="MS">MS - Mato Grosso do Sul</option>
                                                <option value="MG">MG - Minas Gerais</option>
                                                <option value="PA">PA - Pará</option>
                                                <option value="PB">PB - Paraíba</option>
                                                <option value="PR">PR - Paraná</option>
                                                <option value="PE">PE - Pernambuco</option>
                                                <option value="PI">PI - Piauí</option>
                                                <option value="RJ">RJ - Rio de Janeiro</option>
                                                <option value="RN">RN - Rio Grande do Norte</option>
                                                <option value="RS">RS - Rio Grande do Sul</option>
                                                <option value="RO">RO - Rondônia</option>
                                                <option value="RR">RR - Roraima</option>
                                                <option value="SC">SC - Santa Catarina</option>
                                                <option value="SP">SP - São Paulo</option>
                                                <option value="SE">SE - Sergipe</option>
                                                <option value="TO">TO - Tocantins</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Mesorregião 
                                            </label>
                                            <input type="text" name="mesorregiao" id="mesorregiao" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Microrregião
                                            </label>
                                            <input type="text" name="microrregiao" id="microrregião" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Área 
                                            </label>
                                            <input type="text" name="area" id="area" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Altitude 
                                            </label>
                                            <input type="text" name="altitude" id="altitude" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Clima </label>
                                            <select name="clima" id="clima" class="form-control">
                                                <option value=""></option>
                                                <option value="Tropical">Tropical</option>
                                                <option value="Subtropical">Subtropical</option>
                                                <option value="Equatorial">Equatorial</option>
                                                <option value="Semiárido">Semiárido</option>
                                                <option value="Mediterrâneo">Mediterrâneo</option>
                                                <option value="Temperado">Temperado</option>
                                                <option value="Tundra">Tundra</option>
                                                <option value="Árido">Árido</option>                    
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Fuso horário </label>
                                            <select name="fuso_horario" id="fuso_horario" class="form-control">
                                                <option value=""></option>
                                                <option value="America/Noronha">Fernando de Noronha (UTC-2)</option>
                                                <option value="America/Belem">Belém (UTC-3)</option>
                                                <option value="America/Fortaleza">Fortaleza (UTC-3)</option>
                                                <option value="America/Recife">Recife (UTC-3)</option>
                                                <option value="America/Araguaina">Araguaína (UTC-3)</option>
                                                <option value="America/Maceio">Maceió (UTC-3)</option>
                                                <option value="America/Bahia">Bahia (UTC-3)</option>
                                                <option value="America/Sao_Paulo">São Paulo (UTC-3)</option>
                                                <option value="America/Campo_Grande">Campo Grande (UTC-4)</option>
                                                <option value="America/Cuiaba">Cuiabá (UTC-4)</option>
                                                <option value="America/Santarem">Santarém (UTC-4)</option>
                                                <option value="America/Porto_Velho">Porto Velho (UTC-4)</option>
                                                <option value="America/Boa_Vista">Boa Vista (UTC-4)</option>
                                                <option value="America/Manaus">Manaus (UTC-4)</option>
                                                <option value="America/Eirunepe">Eirunepé (UTC-5)</option>
                                                <option value="America/Rio_Branco">Rio Branco (UTC-5)</option>                    
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                População Estimada 
                                            </label>
                                            <input type="text" name="populacao_estimada" id="populacao_estimada" class="form-control" required>
                                        </div>
                                    </div>
                                     
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>
                                                Densidade Demográfica 
                                            </label>
                                            <input type="text" name="densidade" id="densidade" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">	
                                            <label><i class="fa fa-pencil"></i> Descrição (Hitória, cultura e curiosidades)</label>
                                            <textarea type="text" name="descricao" class="form-control" id="descricao"   rows="20" value=""  ></textarea>
                                        </div>
                                    </div>

                                </div><!-- .row  -->

                            </div>
                        </form>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-success  btn-sm mr-2"  id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>


