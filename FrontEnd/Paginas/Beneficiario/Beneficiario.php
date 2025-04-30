<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Registo de Beneficiário</title>
    <link rel="stylesheet" href="../../CSS/Beneficiario/BeneficiarioRegister.css">
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const apoioData = {
                JFE: ["BPAAD", "Viver bem aos 55+"],
                ADICE: ["Formação", "Acompanhamento"],
                REFOOD: ["Cabaz Alimentar", "Refeições"]
            };

            const entidadeSelect = document.getElementById("apoio_entidade");
            const tipoApoioSelect = document.getElementById("tipo_apoio");
            const numElementos = document.getElementById("num_elementos");
            const agregadoContainer = document.getElementById("agregado_campos");

            entidadeSelect.addEventListener("change", () => {
                const entidade = entidadeSelect.value;
                tipoApoioSelect.innerHTML = "";
                if (apoioData[entidade]) {
                    apoioData[entidade].forEach(ap => {
                        const opt = document.createElement("option");
                        opt.value = ap;
                        opt.textContent = ap;
                        tipoApoioSelect.appendChild(opt);
                    });
                }
            });

            numElementos.addEventListener("input", () => {
                agregadoContainer.innerHTML = "";
                const n = parseInt(numElementos.value) || 0;
                for (let i = 0; i < n; i++) {
                    const div = document.createElement("div");
                    div.classList.add("agregado-item");
                    div.innerHTML = `
                        <label>NISS:</label>
                        <input type="text" name="agregado_niss[]">
                        <label>Data de Nascimento:</label>
                        <input type="date" name="agregado_data[]">
                        <label>Género:</label>
                        <select name="agregado_genero[]">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    `;
                    agregadoContainer.appendChild(div);
                }
            });

            document.querySelectorAll(".resposta-btn").forEach(button => {
                button.addEventListener("click", () => {
                    const detalhes = button.nextElementSibling;
                    detalhes.style.display = detalhes.style.display === "block" ? "none" : "block";
                });
            });
        });
    </script>
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo Ermesinde">
        <h1>CLIS</h1>
    </header>

    <main>
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
                <div><label>BI/CC</label><input type="text" name="biccc"></div>
            </div>
            <div class="grid-3">
                <div><label>Morada</label><input type="text" name="morada"></div>
                <div><label>Código Postal</label><input type="text" name="cod_postal"></div>
                <div><label>Data de Nascimento</label><input type="date" name="data_nasc"></div>
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
                        <option value="">Selecione</option>
                        <option value="JFE">JFE</option>
                        <option value="ADICE">ADICE</option>
                        <option value="REFOOD">REFOOD</option>
                    </select>
                </div>
                <div>
                    <label>Tipo de Apoio</label>
                    <select id="tipo_apoio">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>
        </div>

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

        <button type="submit">Criar Beneficiário</button>
    </main>

    <footer>
        <p>Contacto: geral@clis.pt | Tel: 222 222 222</p>
        <div class="redes">
            <a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">LinkedIn</a>
        </div>
        <div class="logos">
            <img src="logo-adice.png" alt="ADICE">
            <img src="logo-jfe.png" alt="JFE">
            <img src="logo-refood.png" alt="Refood">
        </div>
    </footer>
</body>
</html>
