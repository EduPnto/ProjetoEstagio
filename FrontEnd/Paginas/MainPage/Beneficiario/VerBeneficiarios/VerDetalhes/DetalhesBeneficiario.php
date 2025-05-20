<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Beneficiario/Register/BeneficiarioRegister.css">
    <script src='/ProjetoEstagio/BackEnd/Beneficiario/VerAtualizarBeneficiario.js'></script>
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
                <button class="resposta-btn" id="resposta_jfe">JFE</button>
                <div class="resposta-detalhes" id="resposta_jfe_detalhes">
                    <ul>
                        <li id="bpaad">BPAAD</li>
                        <li id="viver_bem_55">Viver bem aos 55+</li>
                    </ul>
                </div>
            </div>
            <div class="resposta-item">
                <button class="resposta-btn" id="resposta_adice">ADICE</button>
                <div class="resposta-detalhes" id="resposta_adice_detalhes">
                    <ul>
                        <li id="formacao">Formação</li>
                        <li id="acompanhamento">Acompanhamento</li>
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
                <div><label for="nome">Nome</label><input type="text" name="nome" id="nome"></div>
                <div style="width: 75%;"><label for="genero">Género</label>
                    <select name="genero" id="genero">
                        <option>Masculino</option>
                        <option>Feminino</option>
                    </select>
                </div>
                <div style="width: 60%;"><label for="contacto">Contacto</label><input type="text" name="contacto" id="contacto"></div>
            </div>
            <div class="grid-3">
                <div>
                    <label for="nif">NIF</label>
                    <input type="text" name="nif" id="nif" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <div>
                    <label for="niss">NISS</label>
                    <input type="text" name="niss" id="niss" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <div>
                    <label for="bi_cc">BI/CC</label>
                    <input type="text" name="bi/cc" id="bi_cc" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>
            <div class="grid-3">
                <div><label for="morada">Morada</label><input type="text" name="morada" id="morada"></div>
                <div class="Postal"><label for="cod_postal">Código Postal</label><input type="text" name="cod_postal" id="cod_postal"></div>
                <div class="Nascimento">
                    <label for="data_nasc">Data de Nascimento</label>
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
            <div>
                <label for="data_admissao">Data de Admissão</label>
                <input type="date" name="data_admissao" id="data_admissao" style="width: 25%;">
            </div>
            <div>
                <label for="data_saida">Data de Saída</label>
                <input type="date" name="data_saida" id="data_saida" style="width: 25%;">
            </div>
        </div>

        <br>
        <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>

        <div class="form-section apoio">
            <h3 style="width: 11.5%;">Tipo de Apoio</h3>
            <div class="grid-4">
                <div style="width: 60%;">
                    <label for="apoio_entidade">Entidade</label>
                    <select id="apoio_entidade" name="apoio_entidade"></select>
                </div>
                <div style="width: 70%;">
                    <label for="tipo_apoio">Tipo de Apoio</label>
                    <select id="tipo_apoio" name="tipo_apoio">
                        <option value="">------</option>
                    </select>
                </div>
                <script>
                    const tipoApoioSelect = document.getElementById('tipo_apoio');
                    const apoioContainer = document.createElement('div');
                    apoioContainer.style.width = '70%';
                    apoioContainer.innerHTML = `
                        <label for="tipo_alimentar">Tipo de Apoio Alimentar</label>
                        <select id="tipo_alimentar" name="tipo_alimentar">
                            <option value="">------</option>
                            <!-- Adiciona opções no carregamento -->
                        </select>
                    `;

                    tipoApoioSelect.addEventListener('change', () => {
                        const parent = tipoApoioSelect.closest('.grid-4');
                        const existingApoio = document.getElementById('tipo_alimentar');
                        if (tipoApoioSelect.value === "Apoio Alimentar") {
                            if (!existingApoio) {
                                parent.appendChild(apoioContainer);
                            }
                        } else if (existingApoio) {
                            apoioContainer.remove();
                        }
                    });
                </script>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section incapacidade">
            <h3 style="width: 33%;">Incapacidade/autonomia do Beneficiário</h3>
            <div class="grid-2">
                <div>
                    <label for="deficiencia_sim">Deficiência/incapacidade:</label><br>
                    <input type="checkbox" name="deficiencia" id="deficiencia_sim"> Sim
                    <input type="checkbox" name="deficiencia" id="deficiencia_nao"> Não
                    <script>
                        const deficienciaSim = document.getElementById('deficiencia_sim');
                        const deficienciaNao = document.getElementById('deficiencia_nao');

                        deficienciaSim.addEventListener('change', () => {
                            if (deficienciaSim.checked) {
                                deficienciaNao.checked = false;
                            }
                        });

                        deficienciaNao.addEventListener('change', () => {
                            if (deficienciaNao.checked) {
                                deficienciaSim.checked = false;
                            }
                        });
                    </script>
                </div>
           </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section abrigo">
            <h3 style="width: 21%;">Situação face sem abrigo</h3>
            <div class="grid-2">
                <div>
                    <label for="sem_abrigo_sim">Situação sem abrigo:</label><br>
                    <input type="checkbox" name="sem_abrigo" id="sem_abrigo_sim"> Sim
                    <input type="checkbox" name="sem_abrigo" id="sem_abrigo_nao"> Não
                    <script>
                        const semAbrigoSim = document.getElementById('sem_abrigo_sim');
                        const semAbrigoNao = document.getElementById('sem_abrigo_nao');

                        semAbrigoSim.addEventListener('change', () => {
                            if (semAbrigoSim.checked) {
                                semAbrigoNao.checked = false;
                            }
                        });

                        semAbrigoNao.addEventListener('change', () => {
                            if (semAbrigoNao.checked) {
                                semAbrigoSim.checked = false;
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section autonomia">
            <h3 style="width: 27.5%;">Situação autonomia/dependência</h3>
            <div class="grid-2">
                <div>
                    <label for="auto">Autonomia/dependência:</label><br>
                    <input type="checkbox" name="autonomo" id="auto"> Autónomo
                    <input type="checkbox" name="dependente" id="depen"> Dependente
                    <script>
                        const auto = document.getElementById('auto');
                        const depen = document.getElementById('depen');

                        auto.addEventListener('change', () => {
                            if (auto.checked) {
                                depen.checked = false;
                            }
                        });

                        depen.addEventListener('change', () => {
                            if (depen.checked) {
                                auto.checked = false;
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section emprego">
            <h3 style="width: 7.5%;">Emprego</h3>
            <div class="grid-2">
                <div>
                    <label for="Empre">Situação face ao emprego:</label><br>
                    <input type="checkbox" name="empregado" id="Empre"> Empregado
                    <input type="checkbox" name="desempregado" id="Desemp"> Desempregado
                    <script>
                        const Empregado = document.getElementById('Empre');
                        const Desempregado = document.getElementById('Desemp');

                        Empregado.addEventListener('change', () => {
                            if (Empregado.checked) {
                                Desempregado.checked = false;
                            }
                        });

                        Desempregado.addEventListener('change', () => {
                            if (Desempregado.checked) {
                                Empregado.checked = false;
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section imigrante">
            <h3 style="width: 8%;">Imigrante</h3>
            <div class="grid-2">
                <div>
                    <label for="imigrante_sim">Imigrante:</label>
                    <input type="checkbox" name="imigrante" id="imigrante_sim" value="sim"> Sim
                    <input type="checkbox" name="imigrante" id="imigrante_nao" value="nao"> Não
                </div>
                <div id="pais_origem_container" style="display: none;">
                    <label for="pais_origem_select">País:</label>
                    <select name="pais_origem" id="pais_origem_select" style="width: 200px;">
                        <option>Selecione</option>
                    </select>
                </div>
                <script>
                    const imigranteSim = document.getElementById('imigrante_sim');
                    const imigranteNao = document.getElementById('imigrante_nao');
                    const paisOrigemContainer = document.getElementById('pais_origem_container');
                    const paisOrigemSelect = document.getElementById('pais_origem_select');

                    imigranteSim.addEventListener('change', () => {
                        if (imigranteSim.checked) {
                            paisOrigemContainer.style.display = 'block';
                            imigranteNao.checked = false;
                        }
                    });

                    imigranteNao.addEventListener('change', () => {
                        if (imigranteNao.checked) {
                            paisOrigemContainer.style.display = 'none';
                            imigranteSim.checked = false;
                            paisOrigemSelect.value = "";
                        }
                    });
                </script>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section rendimento">
            <h3 style="width: 9.5%;">Rendimento</h3>
            <div class="grid-4">
                <div><label for="rendimento_per_Capita">Rendimento per Capita</label><input type="text" name="rendimento_per_Capita" id="rendimento_per_Capita"></div>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section SAAS">
            <h3 style="width: 21%;">Acompanhamento SAAS</h3>
            <div class="grid-2">
                <div>
                    <label for="apoiosaas_sim">Tem acompanhamento SAAS?</label><br>
                    <input type="checkbox" name="apoiosaas_sim" id="apoiosaas_sim"> Sim
                    <input type="checkbox" name="apoiosaas_nao" id="apoiosaas_nao"> Não
                </div>
                <div id="apoioadoSAAS" style="display: none;">
                    <label for="SAASTitular">Nome:</label>
                    <input type="text" name="SAASTitular" id="SAASTitular">
                </div>
                <script>
                    const Apoioado = document.getElementById('apoiosaas_sim');
                    const NApoioado = document.getElementById('apoiosaas_nao');
                    const apoioadoSAASDiv = document.getElementById('apoioadoSAAS');

                    Apoioado.addEventListener('change', () => {
                        if (Apoioado.checked) {
                            NApoioado.checked = false;
                            apoioadoSAASDiv.style.display = 'block';
                        } else {
                            apoioadoSAASDiv.style.display = 'none';
                        }
                    });

                    NApoioado.addEventListener('change', () => {
                        if (NApoioado.checked) {
                            Apoioado.checked = false;
                            apoioadoSAASDiv.style.display = 'none';
                        }
                    });
                </script>
            </div>
        </div>
        <br>
            <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>
        <div class="form-section observacoes">
            <h3 style="width: 11%;">Observações</h3>
            <textarea name="observacoes" id="observacoes" rows="10" cols="80" maxlength="300" style="resize: none; width: 75%;"></textarea>
        </div>
        <form method="">
            <button type="submit" id="btn_Update">Atualizar Beneficiário</button>
        </form>
    </main>

    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
        <div class="logos">
            <img src="../../../../../Imagens/logo_adice.png" alt="ADICE">
            <img src="../../../../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../../../../../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>
    
</body>
</html>
