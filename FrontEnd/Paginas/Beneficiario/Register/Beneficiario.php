<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="../../../CSS/Beneficiario/Register/BeneficiarioRegister.css">
    <script src='/ProjetoEstagio/BackEnd/Beneficiario/Beneficiario.js'></script>
</head>
<body>
    <div class="top-bar">
        <div class="logo" style="background-color: white; display: flex; align-items: center; justify-content: center; padding: 10px; border-radius: 5px;">
            <img src="/ProjetoEstagio/FrontEnd/Imagens/LogotipoJunta.png">
        </div>
        <div class="title">CLIS - Comissão Local de Intervenção Social</div><br>
    </div>

    <main>
    <div class="form-section respostas" style="width: 50%;">
            <h3 style="width: 31%;">Respostas Sociais</h3>
            <div class="resposta-item">
                <button class="resposta-btn">JFE</button>
                <div class="resposta-detalhes">
                    <ul>
                        <li>BPAAD</li>
                        <li>Viver bem aos 55+</li>
                    </ul>
                </div>
            </div>
            <div class="resposta-item">
                <button class="resposta-btn">ADICE</button>
                <div class="resposta-detalhes">
                    <ul>
                        <li>Formação</li>
                        <li>Acompanhamento</li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <h2>Registo de Beneficiário</h2>

        <div class="form-section titular">
            <h3 style="width: 5.5%;">Titular</h3>
            <div class="grid-2">
                <div><label>Nome</label><input type="text" name="nome"></div>
                <div><label>Género</label>
                    <select name="genero">
                        <option>Masculino</option>
                        <option>Feminino</option>
                    </select>
                </div>
            </div>
            <div class="grid-3">
                <div><label>NIF</label><input type="text" name="nif"></div>
                <div><label>NISS</label><input type="text" name="niss"></div>
                <div><label>BI/CC</label><input type="text" name="bi/cc"></div>
            </div>
            <div class="grid-3">
                <div><label>Morada</label><input type="text" name="morada"></div>
                <div class="Postal"><label>Código Postal</label><input type="text" name="cod_postal"></div>
                <div class="Nascimento">
                    <label>Data de Nascimento</label>
                    <input type="date" name="data_nasc" id="data_nasc">
                    <span class="idade-display" id="idade_display">Idade: --</span>
                </div>
            </div>
        </div>

        <br>
        <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>

        <div class="form-section admissao">
            <h3 style="width: 21%;">Admissão do Beneficiário</h3>
            <div class="Admissao">
                <label>Data de Admissão</label>
                <input type="date" name="data_admissao" id="data_admissao" style="width: 25%;">
            </div>
            <div class="Saida">
                <label>Data de Saída</label>
                <input type="date" name="data_saida" id="data_saida" style="width: 25%;">
            </div>
        </div>

        <br>
        <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>

        <div class="form-section agregado">
            <h3 style="width: 15%;">Agregado Familiar</h3>
            <label>Nº de elementos</label>
            <input type="number" id="num_elementos" min="0" max="20" style="width: 50px;" onkeydown="return event.key !== 'e' && event.key !== '-' && event.key !== '+' && event.key !== '.'">
            <div id="agregado_campos"></div>
            <button type="button">Inserir no Registo</button>
        </div>

        <br>
        <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>

        <div class="form-section apoio">
            <h3 style="width: 11.5%;">Tipo de Apoio</h3>
            <div class="grid-2">
                <div style="width: 50%;">
                    <label>Entidade</label>
                    <select id="apoio_entidade">
                        <option value="Default_Value">Selecione</option>
                        <option value="JFE">JFE</option>
                        <option value="ADICE">ADICE</option>
                        <option value="REFOOD">REFOOD</option>
                    </select>
                </div>
                <div style="width: 50%;">
                    <label>Tipo de Apoio</label>
                    <select id="tipo_apoio">
                        <option value="">------</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section incapacidade">
            <h3 style="width: 35%;">Incapacidade/autonomia do Beneficiário</h3>
            <div class="grid-2">
                <div>
                    <label>Deficiência/incapacidade:</label><br>
                    <input type="checkbox" name="deficiencia_sim"> Sim
                    <input type="checkbox" name="deficiencia_nao"> Não
                    <br><br>
                    <label>Situação sem abrigo:</label><br>
                    <input type="checkbox" name="sem_abrigo_sim"> Sim
                    <input type="checkbox" name="sem_abrigo_nao"> Não
                </div>
                <div>
                    <label>Autonomia/dependência:</label><br>
                    <input type="checkbox" name="autonomo"> Autónomo
                    <input type="checkbox" name="dependente"> Dependente
                    <br><br>
                    <label>Situação face ao emprego:</label><br>
                    <input type="checkbox" name="empregado"> Empregado
                    <input type="checkbox" name="desempregado"> Desempregado
                </div>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section imigrante">
            <h3 style="width: 8%;">Imigrante</h3>
            <label>Imigrante:</label>
            <input type="checkbox" name="imigrante_sim"> Sim
            <input type="checkbox" name="imigrante_nao"> Não
            <label style="margin-left: 20px;">País:</label>
            <input type="text" name="pais_origem" style="width: 150px;">
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section observacoes">
            <h3 style="width: 11%;">Observações</h3>
            <textarea name="observacoes" rows="10" cols="80" maxlength="300" style="resize: none; width: 75%;"></textarea>
        </div>

        <button type="submit">Criar Beneficiário</button>
    </main>

    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
        <div class="logos">
            <img src="../../../Imagens/logo_adice.png" alt="ADICE">
            <img src="../../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../../../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
