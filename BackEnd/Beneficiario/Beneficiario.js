document.addEventListener("DOMContentLoaded", () => {
    console.log("");

    const apoioData = {};
    const entidadeSelect = document.getElementById("apoio_entidade");
    const tipoApoioSelect = document.getElementById("tipo_apoio");

    entidadeSelect.addEventListener("change", () => {
        const entidade = entidadeSelect.value;
        tipoApoioSelect.innerHTML = "";

        if (entidade === "Default_Value") {
            tipoApoioSelect.innerHTML = `<option value="">------</option>`;
            return;
        }

        fetch(`/ProjetoEstagio/BackEnd/Beneficiario/Apoios/get_tipos_apoio.php?entidade=${encodeURIComponent(entidade)}`)
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    data.forEach(tipo => {
                        const opt = document.createElement("option");
                        opt.textContent = tipo;
                        tipoApoioSelect.appendChild(opt);
                    });
                } else {
                    tipoApoioSelect.innerHTML = `<option value="">Erro ao carregar</option>`;
                }
            })
            .catch(err => {
                console.error("Erro:", err);
                tipoApoioSelect.innerHTML = `<option value="">Erro ao carregar</option>`;
            });
    });

    fetch('/ProjetoEstagio/BackEnd/Beneficiario/Apoios/get_entidades.php')
    .then(res => res.json())
    .then(data => {
        entidadeSelect.innerHTML = '<option value="Default_Value">Selecione</option>';

        if (Array.isArray(data)) {
            data.forEach(entidade => {
                const opt = document.createElement("option");
                opt.value = entidade;
                opt.textContent = entidade;
                entidadeSelect.appendChild(opt);
            });
        } else {
            entidadeSelect.innerHTML = '<option value="">Erro ao carregar</option>';
        }
    })
    .catch(err => {
        console.error("Erro ao carregar entidades:", err);
        entidadeSelect.innerHTML = '<option value="">Erro ao carregar</option>';
    });
    entidadeSelect.addEventListener("change", () => {
        const entidade = entidadeSelect.value;
        tipoApoioSelect.innerHTML = "";
        if (apoioData[entidade]) {
            apoioData[entidade].forEach(ap => {
                const opt = document.createElement("option");
                opt.value = ap.id;
                opt.textContent = ap.nome;
                tipoApoioSelect.appendChild(opt);
            });
        }
    });
    
    const numElementos = document.getElementById("num_elementos");
    const agregadoContainer = document.getElementById("agregado_campos");

    fetch('/ProjetoEstagio/BackEnd/Beneficiario/get_paises.php')
    .then(res => res.json())
    .then(data => {
        const select = document.getElementById("pais_origem_select");
        data.forEach(pais => {
            const opt = document.createElement("option");
            opt.value = pais.id;
            opt.textContent = `${pais.sigla} - ${pais.nome}`;
            select.appendChild(opt);
        });
    });

    numElementos.addEventListener("input", () => {
        agregadoContainer.innerHTML = "";
        const n = parseInt(numElementos.value) || 0;
        for (let i = 0; i < n; i++) {
            const div = document.createElement("div");
            div.classList.add("agregado-item");
            div.innerHTML = `
                <label>NISS:</label>
                <input type="text" name="agregado_niss" id='agregado_niss' style="width: 50%;">
                <label>Data de Nascimento:</label>
                <input type="date" name="agregado_data" id='agregado_data' style="width: 15%;">
                <label>Género:</label>
                <select name="agregado_genero" style="width: 10%;">
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

    const dataNascInput = document.getElementById("data_nasc");
    const idadeDisplay = document.getElementById("idade_display");

    dataNascInput.addEventListener("input", () => {
        const dataNasc = new Date(dataNascInput.value);
        const hoje = new Date();

        if (!isNaN(dataNasc)) {
            let idade = hoje.getFullYear() - dataNasc.getFullYear();
            const mes = hoje.getMonth() - dataNasc.getMonth();
            if (mes < 0 || (mes === 0 && hoje.getDate() < dataNasc.getDate())) {
                idade--;
            }
            idadeDisplay.textContent = `Idade: ${idade}`;
        } else {
            idadeDisplay.textContent = "Idade: --";
        }
    });
});