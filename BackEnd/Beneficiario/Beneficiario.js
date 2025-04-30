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