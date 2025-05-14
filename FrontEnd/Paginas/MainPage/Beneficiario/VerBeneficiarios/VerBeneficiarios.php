<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>CLIS - Beneficiário</title>
    <link rel="stylesheet" href="/ProjetoEstagio/FrontEnd/CSS/Beneficiario/VerBeneficiarios/VerBeneficiarios.css">
    
</head>
<body>
    <div class="top-bar">
        <div class="logo" style="background-color: white; display: flex; align-items: center; justify-content: center; padding: 10px; border-radius: 5px;">
            <img src="/ProjetoEstagio/FrontEnd/Imagens/LogotipoJunta.png">
        </div>
        <div class="title">CLIS - Comissão Local de Intervenção Social</div><br>
    </div>

    <main>
        <div class="menu-container">
            <input type="text" id="search-niss" placeholder="Pesquisar por NISS..." style="width: 100%; padding: 10px; margin-bottom: 20px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
            <div id="cards-container"></div>
        </div>
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
    <script>
        let todosBeneficiarios = [];

        function verDetalhes(niss) {
            window.location.href = `././VerDetalhes/DetalhesBeneficiario.php?niss=${niss}`;
        }

        function formatarDataBr(dataIso) {
            if (!dataIso) return "Não disponível";
            const data = new Date(dataIso);
            return data.toLocaleDateString('pt-BR');
        }

        function criarCard(beneficiario) {
            const hoje = new Date().toISOString().split('T')[0]; // Data no formato 'YYYY-MM-DD'
            const dataSaida = beneficiario.Data_Saida ? beneficiario.Data_Saida.split('T')[0] : null;

            const mostrarBotaoEliminar = dataSaida === hoje;

            return `
                <div class="card-custom" data-niss="${beneficiario.NISS}">
                    <div class="card-header">
                        <strong>NISS:</strong> ${beneficiario.NISS}
                    </div>
                    <div class="card-content">
                        <div class="data-column">
                            <p><strong>Data de Admissão:</strong> ${formatarDataBr(beneficiario.Data_Admissao)}</p>
                        </div>
                        <div class="data-column">
                            <p><strong>Data de Saída:</strong> ${formatarDataBr(beneficiario.Data_Saida)}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button onclick="verDetalhes('${beneficiario.NISS}')">Ver Detalhes</button>
                        ${mostrarBotaoEliminar ? `<button style="margin-left: 10px; background-color: red;" onclick="eliminarBeneficiario('${beneficiario.NISS}')">Eliminar</button>` : ''}
                    </div>
                </div>
            `;
        }

        function eliminarBeneficiario(niss) {
            if (confirm("Tem certeza que deseja eliminar este beneficiário?")) {
                fetch(`/ProjetoEstagio/BackEnd/Beneficiario/Data/eliminarBeneficiario.php?niss=${niss}`, {
                    method: 'DELETE'
                })
                .then(res => {
                    if (res.ok) {
                        // Remove da lista local e atualiza
                        todosBeneficiarios = todosBeneficiarios.filter(b => b.NISS !== niss);
                        renderCards(todosBeneficiarios);
                        alert("Beneficiário eliminado com sucesso.");
                    } else {
                        alert("Erro ao eliminar beneficiário.");
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert("Erro ao eliminar beneficiário.");
                });
            }
        }

        function renderCards(filtrados) {
            const container = document.getElementById('cards-container');
            container.innerHTML = "";
            filtrados.forEach(beneficiario => {
                container.innerHTML += criarCard(beneficiario);
            });
        }

        function setupSearch() {
            const input = document.getElementById('search-niss');
            input.addEventListener('input', () => {
                const termo = input.value.trim();
                const filtrados = todosBeneficiarios.filter(b => b.NISS.includes(termo));
                renderCards(filtrados);
            });
        }

        // Carregar dados e inicializar tudo
        fetch('/ProjetoEstagio/BackEnd/Beneficiario/Data/getBeneficiarios.php')
            .then(res => res.json())
            .then(data => {
                todosBeneficiarios = data;
                renderCards(todosBeneficiarios);
                setupSearch();
            })
            .catch(error => {
                console.error('Erro ao buscar beneficiários:', error);
            });
    </script>
</body>
</html>
