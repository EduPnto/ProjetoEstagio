let todosEmprestimos = [];

function abrirModalEditar(emprestimo) {
    let modal = document.getElementById('modal-editar-emprestimo');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'modal-editar-emprestimo';
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
        modal.innerHTML = `
            <div style="background:#fff;padding:20px;border-radius:8px;min-width:320px;box-shadow:0 2px 8px #0003;">
                <h3>Editar Empréstimo</h3>
                <label>Quantidade:</label>
                <input type="number" id="input-editar-quantidade" min="1" style="width:100%;margin:8px 0;" />
                <label>Data de Início:</label>
                <input type="date" id="input-editar-inicio" style="width:100%;margin:8px 0;" />
                <label>Data de Entrega:</label>
                <input type="date" id="input-editar-entrega" style="width:100%;margin:8px 0;" />
                <div style="text-align:right;">
                    <button id="btn-cancelar-editar" style="margin-right:10px;background-color: red; color: #fff; border: none; padding: 6px 16px; border-radius: 4px; cursor: pointer;">Cancelar</button>
                    <button id="btn-confirmar-editar" style="background-color: green; color: #fff; border: none; padding: 6px 16px; border-radius: 4px; cursor: pointer;">Salvar</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    document.getElementById('input-editar-quantidade').value = emprestimo.quantidade;
    document.getElementById('input-editar-inicio').value = emprestimo.data_inicio;
    document.getElementById('input-editar-entrega').value = emprestimo.data_entrega;

    modal.style.display = 'flex';

    function fecharModal() {
        modal.style.display = 'none';
    }

    document.getElementById('btn-cancelar-editar').onclick = fecharModal;

    document.getElementById('btn-confirmar-editar').onclick = function () {
        const novaQuantidade = Number(document.getElementById('input-editar-quantidade').value);
        const novaDataInicio = document.getElementById('input-editar-inicio').value;
        const novaDataEntrega = document.getElementById('input-editar-entrega').value;

        if (isNaN(novaQuantidade) || novaQuantidade < 1) {
            alert('Quantidade inválida!');
            return;
        }
        if (!novaDataInicio || !novaDataEntrega) {
            alert('Preencha as datas!');
            return;
        }

        const data = {
            id: emprestimo.id,
            quantidade: novaQuantidade,
            data_inicio: novaDataInicio,
            data_entrega: novaDataEntrega
        };

        fetch('/ProjetoEstagio/BackEnd/Emprestimos/Data/editarEmprestimo.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Empréstimo atualizado com sucesso!');
                window.location.reload();
            } else {
                alert('Erro ao atualizar empréstimo: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao atualizar empréstimo:', error);
        })
        .finally(fecharModal);
    };
}

function terminarEmprestimo(idEmprestimo) {
    if (!confirm('Tem certeza que deseja terminar este empréstimo?')) return;
    fetch('/ProjetoEstagio/BackEnd/Emprestimos/Data/terminarEmprestimo.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${encodeURIComponent(idEmprestimo)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Empréstimo terminado com sucesso!');
            window.location.reload();
        } else {
            alert('Erro ao terminar empréstimo: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erro ao terminar empréstimo:', error);
    });
}

document.addEventListener('DOMContentLoaded', function () {

    function criarCardEmprestimo(emprestimo) {
        return `
            <div class="card-custom" data-emprestimo="${emprestimo.Id_Emprestimo}">
                <div class="card-body">
                    <div class="card-info">
                        <div>
                            <div class="card-header" style="display: flex; gap: 20px; align-items: center;">
                                <p><strong>Beneficiário:</strong> ${emprestimo.nomeBeneficiario}</p>
                                <p><strong>NISS:</strong> ${emprestimo.Niss}</p>
                            </div>
                            <div class="card-content">
                                <p><strong>Produto:</strong> ${emprestimo.nome_Prod}</p>
                                <p><strong>Quantidade:</strong> ${emprestimo.Quantidade}</p>
                                <p><strong>Data de Início:</strong> ${emprestimo.Data_Inicio}</p>
                                <p><strong>Data de Entrega:</strong> ${emprestimo.Data_Entrega}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button style="margin-right: 10px;" onclick="abrirModalEditar(${JSON.stringify(emprestimo).replace(/"/g, '&quot;')})">Alterar Dados</button>
                            <button style="background-color: red;" onclick="terminarEmprestimo('${emprestimo.Id_Emprestimo}')">Terminar Empréstimo</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function renderCardsEmprestimos(lista) {
        const container = document.getElementById('cards-container');
        container.innerHTML = "";
        lista.forEach(emp => {
            container.innerHTML += criarCardEmprestimo(emp);
        });
    }

    function setupSearchEmprestimos() {
        const input = document.getElementById('search-emprestimo');
        input.addEventListener('input', () => {
            const termo = input.value.trim().toLowerCase();
            const filtrados = todosEmprestimos.filter(e =>
                e.nome_beneficiario.toLowerCase().includes(termo) ||
                e.niss_beneficiario.toLowerCase().includes(termo) ||
                e.nome_produto.toLowerCase().includes(termo)
            );
            renderCardsEmprestimos(filtrados);
        });
    }

    fetch('/ProjetoEstagio/BackEnd/Emprestimos/Data/getEmprestimos.php')
    .then(res => res.json())
    .then(data => {
        todosEmprestimos = data;
        renderCardsEmprestimos(todosEmprestimos);
        setupSearchEmprestimos();
    })
    .catch(error => {
        console.error('Erro ao buscar empréstimos:', error);
    });
});
