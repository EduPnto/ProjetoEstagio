
document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");

    if (!id) {
        alert("ID da entidade não fornecido.");
        return;
    }

    fetch(`/ProjetoEstagio/BackEnd/Entidade/get_entidadesInfoById.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("Erro: " + data.error);
                return;
            }

            const entidade = data[0]; // Supondo que retorne um array com um único objeto

            // Entidade
            document.getElementById("nome_entidade").textContent = entidade.nome || "";
            document.getElementById("email").textContent = entidade.email || "";
            document.getElementById("contacto").textContent = entidade.Contacto || "";

            // Logotipo
            if (entidade.logo) {
                document.getElementById("logo_entidade").innerHTML = `<img src="data:image/png;base64,${entidade.logo}" alt="Logotipo" />`;
            }

            // Presidente
            if (entidade.nome_presidente) {
                document.getElementById("nome_presidente").textContent = entidade.nome_presidente;
                document.getElementById("frase_pres").textContent = entidade.frase_president;

                if (entidade.foto_presidente) {
                    document.getElementById("foto_presidente").innerHTML = `<img src="data:image/png;base64,${entidade.foto_presidente}" alt="Foto Presidente" />`;
                }
            }

            // Apoios
            const apoiosLista = document.getElementById("apoios-lista");
            apoiosLista.innerHTML = ""; // limpar

            if (entidade.nome_apoio && Array.isArray(entidade.nome_apoio)) {
                entidade.nome_apoio.forEach(ap => {
                    const li = document.createElement("li");
                    li.textContent = ap;
                    apoiosLista.appendChild(li);
                });
            } else if (entidade.nome_apoio) {
                // Caso apenas um apoio
                const li = document.createElement("li");
                li.textContent = entidade.nome_apoio;
                apoiosLista.appendChild(li);
            }

        })
        .catch(error => {
            console.error("Erro ao buscar dados:", error);
            alert("Erro ao buscar dados da entidade.");
        });
});

