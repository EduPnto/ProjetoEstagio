let todosProdutos = [];

function verDetalhes(nomeProd) {
    const produto = todosProdutos.find(p => p.nome_Prod === nomeProd);
    if (!produto) {
        alert('Produto não encontrado!');
        return;
    }

    let modal = document.getElementById('modal-quantidade');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'modal-quantidade';
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
            <div style="background:#fff;padding:20px;border-radius:8px;min-width:300px;box-shadow:0 2px 8px #0003;">
                <h3>Alterar Quantidade</h3>
                <label>Nova quantidade total:</label>
                <input type="number" id="input-nova-quantidade" min="0" style="width:100%;margin:10px 0;" />
                <div style="text-align:right;">
                    <button id="btn-cancelar-quantidade" style="margin-right:10px;background-color: red; color: #fff; border: none; padding: 6px 16px; border-radius: 4px; cursor: pointer;">Cancelar</button>
                    <button id="btn-confirmar-quantidade" style="background-color: green; color: #fff; border: none; padding: 6px 16px; border-radius: 4px; cursor: pointer;">Alterar</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    document.getElementById('input-nova-quantidade').value = produto.Quantidade;

    modal.style.display = 'flex';

    function fecharModal() {
        modal.style.display = 'none';
    }

    document.getElementById('btn-cancelar-quantidade').onclick = fecharModal;

    document.getElementById('btn-confirmar-quantidade').onclick = function () {
        const novaQuantidade = document.getElementById('input-nova-quantidade').value;
        const quantidadeNum = Number(novaQuantidade);
        if (isNaN(quantidadeNum) || quantidadeNum < 0) {
            alert('Quantidade inválida!');
            return;
        }

        const data = {
            nome: nomeProd,
            quantidade: quantidadeNum
        };

        fetch(`/ProjetoEstagio/BackEnd/Produtos/Data/atualizarQuantidade.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Quantidade atualizada com sucesso!');
                window.location.reload();
            } else {
                alert('Erro ao atualizar quantidade: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao atualizar quantidade:', error);
        })
        .finally(fecharModal);
    };
}

function continuarProduto(nomeProd) {
    fetch(`/ProjetoEstagio/BackEnd/Emprestimos/Data/continuarProduto.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `nome=${encodeURIComponent(nomeProd)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Continuidade do produto dada com sucesso!');
            window.location.reload();
        } else {
            alert('Erro ao continuar o produto: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erro ao continuar o produto:', error);
    });
}

function cancelarContinuidade(nomeProd) {
    fetch('/ProjetoEstagio/BackEnd/Emprestimos/Data/cancelarContinuidade.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `nome=${encodeURIComponent(nomeProd)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Continuidade do produto cancelada com sucesso!');
            window.location.reload();
        } else {
            alert('Erro ao cancelar continuidade: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erro ao cancelar continuidade:', error);
    });
}

document.addEventListener('DOMContentLoaded', function () {

    function criarCard(produto) {
        const continuidadeHtml = produto.Continuidade === '1' || produto.Continuidade === 1
            ? `<span style="color:green;">Tem continuidade</span>`
            : `<span style="color:red;">Não tem continuidade</span>`;

        return `
            <div class="card-custom" data-produto="${produto.nome_Prod}">
                <div class="card-body">
                    <div class="card-logo">
                        <img src="${produto.Image_Prod ? 'data:image/jpeg;base64,' + produto.Image_Prod : '../../../Imagens/default_logo.png'}" alt="${produto.nome_Prod}">
                    </div>
                    <div class="card-info">
                        <div>
                            <div class="card-header" style="display: flex; gap: 20px; align-items: center;">
                                <p><strong>Nome:</strong> ${produto.nome_Prod}</p>
                                <p><strong>Categoria:</strong> ${produto.Categoria}</p>
                            </div>
                            <div class="card-content">
                                <p><strong>Entidade Fornecedora:</strong> ${produto.Entidade}</p>
                                <p><strong>Quantidade Total (Disponível):</strong> ${produto.Quantidade}</p>
                                <p><strong>Quantidade Emprestada:</strong> ${produto.Quantidade_emp}</p>
                                <p><strong>Continuidade:</strong> ${continuidadeHtml}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button style="margin-right: 10px;" onclick="verDetalhes('${produto.nome_Prod}')">Ver Detalhes</button>
                            ${produto.Continuidade == 0 ? `<button style="background-color: green;" onclick="continuarProduto('${produto.nome_Prod}')">Continuar Produto</button>` : ''}
                            ${produto.Continuidade == 1 ? `<button style="background-color: red;"onclick="cancelarContinuidade('${produto.nome_Prod}')">Cancelar</button>` : ''}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function renderCards(lista) {
        const container = document.getElementById('cards-container');
        container.innerHTML = "";
        lista.forEach(prod => {
            container.innerHTML += criarCard(prod);
        });
    }

    function setupSearch() {
        const input = document.getElementById('search-produto');
        input.addEventListener('input', () => {
            const termo = input.value.trim().toLowerCase();
            const filtrados = todosProdutos.filter(p => p.nome_Prod.toLowerCase().includes(termo));
            renderCards(filtrados);
        });
    }

    fetch('/ProjetoEstagio/BackEnd/Produtos/Data/getProdutos.php')
    .then(res => res.json())
    .then(data => {
        todosProdutos = data;
        renderCards(todosProdutos);
        setupSearch();
    })
    .catch(error => {
        console.error('Erro ao buscar produtos:', error);
    });
});