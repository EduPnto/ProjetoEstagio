
        // Função para obter o NISS da URL
        function getNISSFromURL() {
            const params = new URLSearchParams(window.location.search);
            return params.get('niss');
        }

        // Preenche os campos do formulário
        function preencherFormulario(data) {
            if (!data) return;

            document.getElementById('nome').value = data.nome || '';
            document.getElementById('genero').value = data.genero || '';
            document.getElementById('contacto').value = data.contacto || '';
            document.getElementById('nif').value = data.NIF || '';
            document.getElementById('niss').value = data.NISS || '';
            document.getElementById('bi_cc').value = data.bi_cc || '';
            document.getElementById('morada').value = data.morada || '';
            document.getElementById('cod_postal').value = data.cod_postal || '';
            document.getElementById('data_nasc').value = data.data_nasc || '';
            document.getElementById('data_admissao').value = data.data_admissao || '';
            document.getElementById('data_saida').value = data.data_saida || '';
            document.getElementById('observacoes').value = data.observacoes || '';

            // Preenchimento dos checkboxes
            document.getElementById('deficiencia_sim').checked = data.deficiencia === '1';
            document.getElementById('deficiencia_nao').checked = data.deficiencia === '0';

            document.getElementById('sem_abrigo_sim').checked = data.sem_abrigo === '1';
            document.getElementById('sem_abrigo_nao').checked = data.sem_abrigo === '0';

            document.getElementById('auto').checked = data.autonomia === '1';
            document.getElementById('depen').checked = data.autonomia === '0';

            document.getElementById('Empre').checked = data.emprego === '1';
            document.getElementById('Desemp').checked = data.emprego === '0';

            if (data.imigrante === '1') {
            document.getElementById('imigrante_sim').checked = true;
            document.getElementById('pais_origem_container').style.display = 'block';
            document.getElementById('pais_origem_select').value = data.pais_origem || 'Default_Value';
            } else if (data.imigrante === '0') {
            document.getElementById('imigrante_nao').checked = true;
            document.getElementById('pais_origem_container').style.display = 'none';
            }
        }

        // Carregamento automático ao abrir a página
        document.addEventListener('DOMContentLoaded', () => {
            const niss = getNISSFromURL();
            if (!niss) return;

            fetch(`/ProjetoEstagio/BackEnd/Beneficiario/Data/getBeneficiarioPorNiss.php?NISS=${niss}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data && !data.erro) {
                        preencherFormulario(data);
                    } else {
                        console.error('Beneficiário não encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar beneficiário:', error);
                });
        });