document.addEventListener('DOMContentLoaded', function () {
    let todosProdutos = [];

    function verDetalhes(nomeProd) {
        window.location.href = `VerDetalhes/DetalhesProduto.php?nome=${encodeURIComponent(nomeProd)}`;
    }

    function criarCard(produto) {
        const continuidadeHtml = produto.Continuidade === '1' || produto.Continuidade === 1
            ? `<span style="color:green;">✔️ Contínuo</span>`
            : `<span style="color:red;">❌ Não Contínuo</span>`;

        return `
            <div class="card-custom" data-produto="${produto.nome_Prod}">
                <div class="card-body">
                    <div class="card-logo">
                        <img src="${produto.Image_Prod ? 'data:image/jpeg;base64,' + produto.Image_Prod : '../../../Imagens/default_logo.png'}" alt="${produto.nome_Prod}">
                    </div>
                    <div class="card-info">
                        <div>
                            <div class="card-header">
                                <p><strong>Nome:</strong> ${produto.nome_Prod}</p>
                            </div>
                            <div class="card-content">
                                
                                <p><strong>Quantidade Total:</strong> ${produto.Quantidade}</p>
                                <p><strong>Quantidade Emprestada:</strong> ${produto.Quantidade_emp}</p>
                                <p><strong>Continuidade:</strong> ${continuidadeHtml}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button onclick="verDetalhes('${produto.nome_Prod}')">Ver Detalhes</button>
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
        console.log(data); // verifica se está como array de objetos
        todosProdutos = data;
        renderCards(todosProdutos);
        setupSearch();
    })
    .catch(error => {
        console.error('Erro ao buscar produtos:', error);
    });
});