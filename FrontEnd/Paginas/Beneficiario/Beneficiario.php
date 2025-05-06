<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="<?php echo '/ProjetoEstagio/FrontEnd/CSS/Beneficiario/BeneficiarioRegister.css'; ?>">
    <script src='/ProjetoEstagio/BackEnd/Beneficiario/Beneficiario.js'></script>
</head>
<body>
    <div class="top-bar">
        <div class="logo" style="background-color: white; display: flex; align-items: center; justify-content: center; padding: 10px;">
            <img src="/ProjetoEstagio/FrontEnd/Imagens/LogotipoJunta.png">
        </div>
        <div class="title">CLIS - Comissão Local de Intervenção Social</div>
        <div class="user-info">
            <?php $username = "Refood"; ?>
            <div><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong></div>
            <img src="../Imagens/default-user.png" alt="User" class="user-img">
        </div>
    </div>

    <main>
    <div class="form-section respostas">
            <h3>Respostas Sociais</h3>
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
        
        <h2>Registo de Beneficiário</h2>

        <div class="form-section titular">
            <h3>Titular</h3>
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

        <div class="form-section agregado">
            <h3>Agregado Familiar</h3>
            <label>Nº de elementos</label>
            <input type="number" id="num_elementos" min="0">
            <div id="agregado_campos"></div>
            <button type="button">Inserir no Registo</button>
        </div>

        <div class="form-section apoio">
            <h3>Tipo de Apoio</h3>
            <div class="grid-2">
                <div>
                    <label>Entidade</label>
                    <select id="apoio_entidade">
                        <option value="Default_Value">Selecione</option>
                        <option value="JFE">JFE</option>
                        <option value="ADICE">ADICE</option>
                        <option value="REFOOD">REFOOD</option>
                    </select>
                </div>
                <div>
                    <label>Tipo de Apoio</label>
                    <select id="tipo_apoio">
                        <option value="">------</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit">Criar Beneficiário</button>
    </main>

    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
        <div class="logos">
            <img src="logo-adice.png" alt="ADICE">
            <img src="logo-jfe.png" alt="JFE">
            <img src="logo-refood.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
