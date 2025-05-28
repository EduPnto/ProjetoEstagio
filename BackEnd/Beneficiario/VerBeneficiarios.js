document.addEventListener('DOMContentLoaded', function () {
    let todosBeneficiarios = [];

    function verDetalhes(niss) {
        window.location.href = `VerDetalhes/DetalhesBeneficiario.php?niss=${niss}`;
    }

    function formatarDataBr(dataIso) {
        if (!dataIso) return "Não disponível";
        const data = new Date(dataIso);
        return data.toLocaleDateString('pt-BR');
    }

    function criarCard(beneficiario) {
        const hoje = new Date().toISOString().split('T')[0];
        const dataSaida = beneficiario.Data_Saida ? beneficiario.Data_Saida.split('T')[0] : null;
        const mostrarBotaoAlterarDatas = dataSaida && dataSaida <= hoje;

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
                    <div class="data-column">
                        <p><strong>Contacto:</strong> ${beneficiario.Contacto}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <button onclick="verDetalhes('${beneficiario.NISS}')">Ver Detalhes</button>
                    ${mostrarBotaoAlterarDatas ? `
                        <button style="margin-left: 10px; background-color: orange;" 
                            onclick="alterarDatas('${beneficiario.NISS}', '${beneficiario.Data_Admissao}', '${beneficiario.Data_Saida}')">
                            Alterar Datas
                        </button>` : ''}
                </div>
            </div>
        `;
    }

    // Cria e exibe o modal para alterar datas
    window.alterarDatas = function (niss, dataAdmissaoAtual, dataSaidaAtual) {
        const modalExistente = document.getElementById('modal-alterar-datas');
        if (modalExistente) modalExistente.remove();

        const modal = document.createElement('div');
        modal.id = 'modal-alterar-datas';
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100vw';
        modal.style.height = '100vh';
        modal.style.background = 'rgba(0,0,0,0.5)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        modal.style.zIndex = '9999';

        const box = document.createElement('div');
        box.style.background = '#fff';
        box.style.padding = '30px 20px';
        box.style.borderRadius = '8px';
        box.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
        box.style.minWidth = '320px';
        box.innerHTML = `
        <h3 style="text-align:center; margin-top:0;">Alterar Datas</h3>
        <label style="display:block; margin-bottom:10px;">Data de Admissão:<br>
        <input type="date" id="nova-data-admissao" value="${dataAdmissaoAtual ? dataAdmissaoAtual.split('T')[0] : ''}" 
            style="width: 80%; padding: 10px; margin-top: 5px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
        </label>
        <label style="display:block; margin-bottom:20px;">Data de Saída:<br>
        <input type="date" id="nova-data-saida" value="${dataSaidaAtual ? dataSaidaAtual.split('T')[0] : ''}" 
            style="width: 80%; padding: 10px; margin-top: 5px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
        </label>
        <div style="text-align:center;">
        <button id="btn-alterar-datas" style="padding: 8px 18px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; font-size: 15px; cursor: pointer;">Alterar</button>
        <button id="btn-cancelar-datas" style="padding: 8px 18px; background-color: #6c757d; color: #fff; border: none; border-radius: 5px; font-size: 15px; cursor: pointer; margin-left:10px;">Cancelar</button>
        </div>
        `;

        modal.appendChild(box);
        document.body.appendChild(modal);

        document.getElementById('btn-cancelar-datas').onclick = () => modal.remove();

        document.getElementById('btn-alterar-datas').onclick = () => {
            const novaDataAdmissao = document.getElementById('nova-data-admissao').value;
            const novaDataSaida = document.getElementById('nova-data-saida').value;

            if (!novaDataAdmissao || !novaDataSaida) {
                alert('Preencha ambas as datas.');
                return;
            }
            if (confirm('Tem a certeza que deseja alterar as datas?')) {
                fetch(`/ProjetoEstagio/BackEnd/Beneficiario/Data/alterarDatasBeneficiario.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        niss: niss,
                        data_admissao: novaDataAdmissao,
                        data_saida: novaDataSaida
                    })
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Erro na resposta da rede: ' + res.status);
                    }
                    return res.json();
                })
                .then(response => {
                    if (response.success) {
                        todosBeneficiarios = todosBeneficiarios.map(b =>
                            b.NISS === niss
                                ? { ...b, Data_Admissao: novaDataAdmissao, Data_Saida: novaDataSaida }
                                : b
                        );
                        renderCards(todosBeneficiarios);
                        alert("Datas alteradas com sucesso.");
                        modal.remove();
                    } else {
                        alert("Erro ao alterar datas: " + (response.message || ""));
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert("Erro ao alterar datas.");
                });
            }
        };
    };

    window.verDetalhes = verDetalhes;

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
});
