<main class="col-md-10">

    <img src="../img/loading.gif" id="spinner" class="mainSpinner" width="120" style="position: absolute; z-index: 1; top: 250px; left: 600px; display: none" />

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
        <div class="col-md-11">
            <span class="span-30" style="color: gray"><i class="fa fa-plus-square"></i> Epidemiologia </span><span class="gray">Vacinação</span>
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

            <div class="tab-pane active" id="home" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-building-o"></i> <i><b>Dados do Paciente</b></i>

                            &emsp;
                            <span id="tab_1_alerts"></span>
                            <img class="loading" src="../img/loading-sm.svg" style="display: none">
                            </svg>

                        </div>
                    </div>
                </div>

                <form id="tab-1-form-1">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Nome do Paciente<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="paciente_nome" id="paciente_nome" class="form-control" placeholder="Nome">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Número CNS</label>
                                <input type="text" class="form-control" name="paciente_cns" id="paciente_cns" class="form-control" placeholder="Número do CNS">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Número CPF<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="paciente_cpf" id="paciente_cpf" class="form-control" placeholder="Número do CPF">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Sexo<span id="asterisco" style="color:#F00">*</span></label>
                                <select name="sexo" id="sexo" class="form-control">
                                    <option value='m'>Masculino</option>
                                    <option value='f'>Feminino</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Cidade de Nascimento<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="local_nascimento" id="local_nascimento" class="form-control" placeholder="Cidade de Nascimento">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label> UF<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="local_nascimento_uf" id="local_nascimento_uf" class="form-control" placeholder="UF">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Nome da Mâe<span id="asterisco" style="color:#F00">*</span></label>                                
                                <input type="text" class="form-control" name="mae" id="mae" class="form-control" placeholder="Nome da Mãe">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Data de Nascimento<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label> Idade<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="idade" id="idade" class="form-control" placeholder="Idade">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Categoria do Paciente<span id="asterisco" style="color:#F00">*</span></label>
                                <select name="vacina_categoria_nome" id="vacina_categoria_nome" class="form-control">
                                    <option value="">Selecione uma categoria</option>
                                    <option value='1 - PROFISSIONAIS DA SA%C3%9ADE'>1 - PROFISSIONAIS DA SAÚDE</option>
                                    <option value='2 - IDOSOS COM 75 ANOS OU MAIS'>2 - IDOSOS COM 75 ANOS OU MAIS</option>
                                    <option value='3 - IDOSOS COM 60 ANOS OU MAIS%2C QUE VIVEM EM ASILOS'>3 - IDOSOS COM 60 ANOS OU MAIS, QUE VIVEM EM ASILOS</option>
                                    <option value='4 - IND%C3%8DGENAS'>4 - INDÍGENAS</option>
                                    <option value='5 - IDOSOS COM 70 ANOS OU MAIS '>5 - IDOSOS COM 70 ANOS OU MAIS </option>
                                    <option value='COMORBIDADES'>COMORBIDADES</option>
                                    <option value='COMORBIDADES'>COMORBIDADES</option>
                                    <option value='FOR%C3%87A DE SEGURAN%C3%87A'>FORÇA DE SEGURANÇA</option>
                                    <option value='IDOSO '>IDOSO </option>
                                    <option value='IDOSO DE 60 A 69 ANOS'>IDOSO DE 60 A 69 ANOS</option>
                                    <option value='IDOSOS COM 70 ANOS OU MAIS '>IDOSOS COM 70 ANOS OU MAIS </option>
                                    <option value='PESSOAS COM DEFICIENCIA '>PESSOAS COM DEFICIENCIA </option>
                                    <option value='PROFISSIONAL DA SAUDE '>PROFISSIONAL DA SAUDE </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Subcategoria do Paciente<span id="asterisco" style="color:#F00">*</span></label>                                
                                <select name="vacina_subcategoria_nome" id="vacina_subcategoria_nome" class="form-control">
                                    <option value="">Selecione uma sub categoria</option>
                                    <option value='ACIMA DE 70 ANOS '>ACIMA DE 70 ANOS </option>
                                    <option value='ACIMA DE 70 ANOS OU MAIS '>ACIMA DE 70 ANOS OU MAIS </option>
                                    <option value='ASSISTENTE SOCIAL'>ASSISTENTE SOCIAL</option>
                                    <option value='AUXILIAR DE ENFERMAGEM'>AUXILIAR DE ENFERMAGEM</option>
                                    <option value='CARDIOPATIAS'>CARDIOPATIAS</option>
                                    <option value='COZINHEIRO E AUXILIARES'>COZINHEIRO E AUXILIARES</option>
                                    <option value='CP RAIO'>CP RAIO</option>
                                    <option value='DEMUTRAN'>DEMUTRAN</option>
                                    <option value='DIABETES MELLITUS'>DIABETES MELLITUS</option>
                                    <option value='DIABETES MELLITUS'>DIABETES MELLITUS</option>
                                    <option value='DIABETES MELLITUS'>DIABETES MELLITUS</option>
                                    <option value='DIABETES MELLITUS'>DIABETES MELLITUS</option>
                                    <option value='DOEN%C3%87AS NEUROLÓGICAS'>DOENÇAS NEUROLÓGICAS</option>
                                    <option value='DOEN%C3%87AS RENAIS CRÔNICA -DRC'>DOENÇAS RENAIS CRÔNICA -DRC</option>
                                    <option value='EMPRESAS PRIVADAS '>EMPRESAS PRIVADAS </option>
                                    <option value='ENFERMEIRO%28A%29'>ENFERMEIRO(A)</option>
                                    <option value='FARMAC%C3%8AUTICO'>FARMACÊUTICO</option>
                                    <option value='FISIOTERAPEUTAS'>FISIOTERAPEUTAS</option>
                                    <option value='FONOAUDI%C3%93LOGO'>FONOAUDIÓLOGO</option>
                                    <option value='FUNCION%C3%81RIO DO SISTEMA FUNERÁRIO C%2F CADÁVERES POTENCIALMENTE CONTAMINADOS'>FUNCIONÁRIO DO SISTEMA FUNERÁRIO C/ CADÁVERES POTENCIALMENTE CONTAMINADOS</option>
                                    <option value='GESTANTES '>GESTANTES </option>
                                    <option value='IDOSOS'>IDOSOS</option>
                                    <option value='IDOSOS COM 70 ANOS OU MAIS '>IDOSOS COM 70 ANOS OU MAIS </option>
                                    <option value='IDOSOS DE 60 A 69 ANOS'>IDOSOS DE 60 A 69 ANOS</option>
                                    <option value='IMUNODEFICI%C3%8ANCIA'>IMUNODEFICIÊNCIA</option>
                                    <option value='IND%C3%8DGENAS'>INDÍGENAS</option>
                                    <option value='M%C3%89DICO'>MÉDICO</option>
                                    <option value='M%C3%89DICO VETERIN%C3%81RIO'>MÉDICO VETERINÁRIO</option>
                                    <option value='MOTORISTA DE AMBUL%C3%82NCIA'>MOTORISTA DE AMBULÂNCIA</option>
                                    <option value='NUTRICIONISTA'>NUTRICIONISTA</option>
                                    <option value='OBESIDADES GRAU III OU MORBIDA %28IMC IGUAL OU SUPERIOR A 40KG%2FM2%29'>OBESIDADES GRAU III OU MORBIDA (IMC IGUAL OU SUPERIOR A 40KG/M2)</option>
                                    <option value='ODONTOLOGISTA'>ODONTOLOGISTA</option>
                                    <option value='OUTROS'>OUTROS</option>
                                    <option value='PESSOA COM DEFICIENCIA PERMANENTE GRAVE '>PESSOA COM DEFICIENCIA PERMANENTE GRAVE </option>
                                    <option value='PESSOAL DA LIMPEZA'>PESSOAL DA LIMPEZA</option>
                                    <option value='PESSOAS ACIMA DE 70 ANOS '>PESSOAS ACIMA DE 70 ANOS </option>
                                    <option value='PESSOAS COM DEFICIÊNCIAS PERMANENTE GRAVE'>PESSOAS COM DEFICIÊNCIAS PERMANENTE GRAVE</option>
                                    <option value='PESSOAS DE 60 NOS OU MAIS INSTITUCIONALIZADAS'>PESSOAS DE 60 NOS OU MAIS INSTITUCIONALIZADAS</option>
                                    <option value='PESSOAS DE 65 A 69 ANOS'>PESSOAS DE 65 A 69 ANOS</option>
                                    <option value='PESSOAS DE 70 A 74 ANOS'>PESSOAS DE 70 A 74 ANOS</option>
                                    <option value='PESSOAS DE 75 A 79 ANOS'>PESSOAS DE 75 A 79 ANOS</option>
                                    <option value='PESSOAS DE 80 ANOS OU MAIS'>PESSOAS DE 80 ANOS OU MAIS</option>
                                    <option value='PNEUMOPATIAS (CRONICA E GRAVE)'>PNEUMOPATIAS (CRONICA E GRAVE)</option>
                                    <option value='POLÍCIA CIVIL'>POLÍCIA CIVIL</option>
                                    <option value='POLÍCIA MILITAR'>POLÍCIA MILITAR</option>
                                    <option value='POLÍCIA RODOVIÁRIA FEDERAL'>POLÍCIA RODOVIÁRIA FEDERAL</option>
                                    <option value='PROFISSIONAIS DE EDUCAÇÃO FÍSICA'>PROFISSIONAIS DE EDUCAÇÃO FÍSICA</option>
                                    <option value='PSICÓLOGO'>PSICÓLOGO</option>
                                    <option value='PUÉRPERAS'>PUÉRPERAS </option>
                                    <option value='RECEPCIONISTA'>RECEPCIONISTA</option>
                                    <option value='SEGURANÇA'>SEGURANÇA</option>
                                    <option value='SEPULTADORES (COVEIROS) E AGENTES FUNERÁRIOS'>SEPULTADORES (COVEIROS) E AGENTES FUNERÁRIOS</option>
                                    <option value='SÍNDROME DE DOWN'>SÍNDROME DE DOWN</option>
                                    <option value='TÉCNICO DE ENFERMAGEM'>TÉCNICO DE ENFERMAGEM</option>
                                    <option value='TÉCNICO DE ODONTOLOGIA'>TÉCNICO DE ODONTOLOGIA</option>
                                    <option value='TERAPEUTA OCUPACIONAL'>TERAPEUTA OCUPACIONAL</option>
                                </select>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Dose<span id="asterisco" style="color:#F00">*</span></label> 
                                <select name="vacina_numero_dose" id="vacina_numero_dose" class="form-control">
                                    <option value='1'>1º Dose </option>
                                    <option value='2'>2º Dose </option>
                                    <option value='3'>3º Dose </option>
                                    <option value='4'>4º Dose </option>
                                    <option value='5'>5º Dose </option>
                                    <option value='6'>6º Dose </option>
                                    <option value='7'>7º Dose </option>
                                    <option value='8'>8º Dose </option>
                                    <option value='9'>9º Dose </option>
                                </select>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Vacina<span id="asterisco" style="color:#F00">*</span></label> 
                                <select name="vacina_nome" id="vacina_nome" class="form-control">
                                    <option value="">Vacina</option>
                                    <option value='Comirnaty (Pfizer/Wyeth)'>Comirnaty (Pfizer/Wyeth)</option>
                                    <option value='Comirnaty bivalente (Pfizer)'>Comirnaty bivalente (Pfizer)</option>
                                    <option value='Coronavac-Sinovac/Butanvac'>Coronavac-Sinovac/Butanvac </option>
                                    <option value='Covishield'>Covishield </option>
                                    <option value='Janssen Vaccine (Janssen-Cilag)'>Janssen Vaccine (Janssen-Cilag)</option>
                                    <option value='Oxford/Covishield (Fiocruz e Astrazeneca)'>Oxford/Covishield (Fiocruz e Astrazeneca)</option>
                                    <option value='Spikevax bivalente'>Spikevax bivalente</option>                                    
                                </select>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Data de Aplicação<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="date" class="form-control" name="data_aplicacao" id="data_aplicacao" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Nome do aplicador<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="nome_aplicador_vacina" id="nome_aplicador_vacina" class="form-control" placeholder="Nome do aplicador">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> CPF do aplicador<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="cpf_aplicador_vacina" id="cpf_aplicador_vacina" class="form-control" placeholder="CPF do aplicador">
                            </div>
                        </div>
                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome do estabelecimento aplicador<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="nome_estabelecimento" id="nome_estabelecimento" class="form-control" placeholder="Nome do estabelecimento aplicador">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bairro do estabelecimento aplicador<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="bairro_estabelecimento" id="bairro_estabelecimento" class="form-control" placeholder="Bairro do estabelecimento aplicador">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Municipio do estabelecimento aplicador<span id="asterisco" style="color:#F00">*</span></label>
                                <input type="text" class="form-control" name="municipio_estabelecimento" id="municipio_estabelecimento" class="form-control" placeholder="Municipio do estabelecimento aplicador">
                            </div>
                        </div>


                    </div><!-- row -->
                </form>
                <!-- BOTÕES DA ABA CADASTRO -->
                <hr>

                <div class="d-flex justify-content-between">
                    <div>

                    </div>
                    <div class="d-flex" id="botoes-foot">
                        <a href="../vacinacao/" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                        <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>
                    </div>
                </div>

            </div>


        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br />
</main> <!-- .col-md-10 -->