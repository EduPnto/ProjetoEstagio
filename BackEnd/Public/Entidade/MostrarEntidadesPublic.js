let todasEntidades = [];

        function verDetalhesEntidade(Id_Enti) {
            window.location.href = `VerDetalhes/DetalhesEntidadePublic.php?id=${Id_Enti}`;
        }

        function criarCard(entidade) {
            const logoSrc = entidade.logo ? `data:image/jpeg;base64,${entidade.logo}` : '../../../Imagens/default_logo.png';
            
            return `
                <div class="card-custom" data-id="${entidade.Id_Enti}">
                    <div class="card-body">
                        <div class="card-logo">
                            <img src="${entidade.logo ? 'data:image/jpeg;base64,' + entidade.logo : '../../../Imagens/default_logo.png'}" alt="Logo da entidade">
                        </div>
                        <div class="card-info">
                            <div>
                                <div class="card-header">
                                    <strong>${entidade.nome}</strong> (${entidade.Sigla})
                                </div>
                                <div class="card-content">
                                    <p><strong>Contacto:</strong> ${entidade.Contacto}</p>
                                    <p><strong>Email:</strong> ${entidade.email}</p>
                                    <p><strong>Qtd. Beneficiários:</strong> ${entidade.total_beneficiarios}</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button onclick="verDetalhesEntidade('${entidade.Id_Enti}')">Ver Detalhes</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderCards(lista) {
            const container = document.getElementById('cards-container');
            container.innerHTML = "";
            lista.forEach(entidade => {
                container.innerHTML += criarCard(entidade);
            });
        }

        function setupSearch() {
            const input = document.getElementById('search-entidade');
            input.addEventListener('input', () => {
                const termo = input.value.trim().toLowerCase();
                const filtradas = todasEntidades.filter(e =>
                    e.nome.toLowerCase().includes(termo) || e.Sigla.toLowerCase().includes(termo)
                );
                renderCards(filtradas);
            });
        }

        // Carrega os dados
        fetch('/ProjetoEstagio/BackEnd/Entidade/get_entidades.php')
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data)) {
                    todasEntidades = data;
                    renderCards(todasEntidades);
                    setupSearch();
                } else {
                    console.error('Resposta inesperada do servidor:', data);
                }
            })
            .catch(error => {
                console.error('Erro ao carregar entidades:', error);
            });