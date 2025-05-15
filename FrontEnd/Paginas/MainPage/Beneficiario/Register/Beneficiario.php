<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="../../../../CSS/Beneficiario/Register/BeneficiarioRegister.css">
    <script src='/ProjetoEstagio/BackEnd/Beneficiario/Beneficiario.js' defer></script>
</head>
<body>
    <?php
        $data = json_decode(file_get_contents("php://input"), true);
        require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT MAX(Id_Bene) AS max_id FROM beneficiarios");
        $row = $result->fetch_assoc();
        $new_id_bene = $row['max_id'] + 1;
    ?>
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
                <div><label for="nome">Nome</label><input type="text" name="nome" id="nome" required></div>
                <div style="width: 75%;"><label for="genero">Género</label>
                    <select name="genero" id="genero" required>
                        <option>------</option>
                        <option>Masculino</option>
                        <option>Feminino</option>
                    </select>
                </div>
                <div style="width: 60%;"><label for="contacto">Contacto</label><input type="text" name="contacto" id="contacto" required></div>
            </div>
            <div class="grid-3">
                <div>
                    <label for="nif">NIF</label>
                    <input type="text" name="nif" id="nif" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>
                <div>
                    <label for="niss">NISS</label>
                    <input type="text" name="niss" id="niss" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>
                <div>
                    <label for="bi_cc">BI/CC</label>
                    <input type="text" name="bi/cc" id="bi_cc" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>
            </div>
            <div class="grid-3">
                <div><label for="morada">Morada</label><input type="text" name="morada" id="morada" required></div>
                <div class="Postal"><label for="cod_postal">Código Postal</label><input type="text" name="cod_postal" id="cod_postal" required></div>
                <div class="Nascimento">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" name="data_nasc" id="data_nasc" required>
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
                <input type="date" name="data_admissao" id="data_admissao" style="width: 25%;" required>
            </div>
            <div>
                <label for="data_saida">Data de Saída</label>
                <input type="date" name="data_saida" id="data_saida" style="width: 25%;" required>
            </div>
        </div>

        <br>
        <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>

        <div class="form-section agregado">
            <h3 style="width: 15%;">Agregado Familiar</h3>
            <label for="num_elementos">Nº de elementos</label>
            <input type="number" id="num_elementos" min="0" max="20" style="width: 50px;">
            <script>
                const input = document.getElementById('num_elementos');
                const max = 20;

                input.addEventListener('input', () => {
                    const valor = parseInt(input.value, 10);

                    if (!isNaN(valor) && valor > max) {
                    input.value = max;
                    }
                });
            </script>
            <div id="agregado_campos"></div>
            <form method="POST" id="familiarForm">
                <button type="button" id="Inserir_Familiar" style="float: right;">Inserir no registo</button>
            </form>
            <script>
                document.getElementById("Inserir_Familiar").addEventListener("click", () => {
                    const niss = Array.from(document.querySelectorAll("#agregado_niss")).map(input => input.value);
                    const datas = Array.from(document.querySelectorAll("#agregado_data")).map(input => input.value);
                    const generos = Array.from(document.querySelectorAll("[name='agregado_genero']")).map(select => select.value);

                    const formData = new FormData();
                    niss.forEach((v, i) => {
                        formData.append('Id_Bene', <?php echo $new_id_bene; ?>);
                        formData.append(`agregado_niss[]`, v);
                        formData.append(`agregado_data[]`, datas[i]);
                        formData.append(`agregado_genero[]`, generos[i]);
                    });

                    fetch("/ProjetoEstagio/BackEnd/Beneficiario/Familiar/inserir_familiar.php", {
                        method: "POST",
                        body: formData
                    }).then(response => response.text())
                    .then(result => alert(result))
                    .catch(error => alert("Erro ao inserir: " + error));
                });
            </script>
        </div>

        <br>
        <label style="opacity: 25%;">___________________________________________________________________________________________________________________________</label>
        <br>

        <div class="form-section apoio">
            <h3 style="width: 11.5%;">Tipo de Apoio</h3>
            <div class="grid-4">
                <div style="width: 60%;">
                    <label for="apoio_entidade">Entidade</label>
                    <select id="apoio_entidade" name="apoio_entidade" required></select>
                </div>
                <div style="width: 70%;">
                    <label for="tipo_apoio">Tipo de Apoio</label>
                    <select id="tipo_apoio" name="tipo_apoio" required>
                        <option value="">------</option>
                    </select>
                </div>
                <div id="apoio_alimentar_container" style="width: 80%; display: none;">
                    <label for="tipo_alimentar">Tipo de Apoio Alimentar</label>
                    <select id="tipo_alimentar" name="tipo_apoio_alimentar" required>
                    </select>
                </div>
                <script>
                    const tipoApoioSelect = document.getElementById('tipo_apoio');
                    const apoioAlimentarContainer = document.getElementById('apoio_alimentar_container');

                    tipoApoioSelect.addEventListener('change', () => {
                        if (tipoApoioSelect.value === "Apoio Alimentar") {
                            apoioAlimentarContainer.style.display = 'block';
                        } else {
                            apoioAlimentarContainer.style.display = 'none';
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
                    <input type="checkbox" name="deficiencia" id="deficiencia_sim" required> Sim
                    <input type="checkbox" name="deficiencia" id="deficiencia_nao" required> Não
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
                        <option value="Default_Value">Selecione</option>
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
                            paisOrigemSelect.value = "Default_Value";
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
        <form method="POST">
            <button type="submit" id="btn_criar">Criar Beneficiário</button>
        </form>
        <script>
            document.getElementById("btn_criar").addEventListener("click", function(event) {
                event.preventDefault(); 

                const data = {
                    Id_Bene: <?php echo $new_id_bene; ?>,
                    nome: document.getElementById("nome").value,
                    genero: document.getElementById("genero").value,
                    contacto: document.getElementById("contacto").value,
                    nif: document.getElementById("nif").value,
                    niss: document.getElementById("niss").value,
                    bi_cc: document.getElementById("bi_cc").value,
                    morada: document.getElementById("morada").value,
                    cod_postal: document.getElementById("cod_postal").value,
                    data_nasc: document.getElementById("data_nasc").value,
                    data_admissao: document.getElementById("data_admissao").value,
                    data_saida: document.getElementById("data_saida").value,
                    tipo_apoio: document.getElementById("tipo_apoio").value,
                    apoio_entidade: document.getElementById("apoio_entidade").value,
                    tipo_alimentar: document.getElementById("tipo_alimentar").value,
                    deficiencia: document.getElementById("deficiencia_sim").checked ? 1 : (document.getElementById("deficiencia_nao").checked ? 0 : null),
                    sem_abrigo: document.getElementById("sem_abrigo_sim").checked ? 1 : (document.getElementById("sem_abrigo_nao").checked ? 0 : null),
                    autonomia: document.getElementById("auto").checked ? 1 : (document.getElementById("depen").checked ? 0 : null),
                    emprego: document.getElementById("Empre").checked ? 1 : (document.getElementById("Desemp").checked ? 0 : null),
                    imigrante: document.getElementById("imigrante_sim").checked ? 1 : (document.getElementById("imigrante_nao").checked ? 0 : null),
                    pais_origem: document.getElementById("pais_origem_select").value,
                    rendimento_per_Capita: document.getElementById("rendimento_per_Capita").value,
                    apoio_saas: document.getElementById("apoiosaas_sim").checked ? 1 : (document.getElementById("apoiosaas_nao").checked ? 0 : null),
                    SAASTitular: document.getElementById("SAASTitular").value ? '' : null,
                    observacoes: document.getElementById("observacoes").value
                };

                fetch('/ProjetoEstagio/BackEnd/Beneficiario/registar_beneficiario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert(result.message);
                    } else {
                        alert("Erro: " + result.message);
                    }
                })
            });
        </script>    
    </main>

    <footer>
        <p>Contacto: geral@clis.jfe.pt | Tel: 227 344 418</p>
        <div class="redes">
            <a href="https://www.facebook.com/Freguesia.de.Ermesinde/?locale=pt_PT">Facebook</a> | <a href="https://www.instagram.com/jfermesinde/">Instagram</a>
        </div>
        <div class="logos">
            <img src="../../../../Imagens/logo_adice.png" alt="ADICE">
            <img src="../../../../Imagens/LogotipoJunta.png" alt="JFE" style="background-color: white; border-radius: 5px; padding: 5px;">
            <img src="../../../../Imagens/rfe.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
