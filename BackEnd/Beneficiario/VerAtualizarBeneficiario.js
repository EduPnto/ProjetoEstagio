document.addEventListener('DOMContentLoaded', () => {
    const niss = getNISSFromURL();
    if (!niss) return;

    fetch(`/ProjetoEstagio/BackEnd/Beneficiario/Data/getBeneficiarioPorNiss.php?NISS=${niss}`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Se o PHP retorna um array, pegue o primeiro elemento
            const beneficiario = Array.isArray(data) ? data[0] : data;
            if (beneficiario && !beneficiario.erro) {
                preencherFormulario(beneficiario);
            } else {
                console.error('Beneficiário não encontrado.');
            }
        })
        .catch(error => {
            console.error('Erro ao carregar beneficiário:', error);
        });
});

function getNISSFromURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get('niss');
}

// Preenche os campos do formulário
function preencherFormulario(data) {
    if (!data) return;

    const setValue = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.value = value;
    };
    const setChecked = (id, checked) => {
        const el = document.getElementById(id);
        if (el) el.checked = checked;
    };

    setValue('nome', data.nome_Bene || data.nome || '');
    setValue('genero', data.Genero || data.genero || '');
    setValue('nif', data.NIF || data.nif || '');
    setValue('niss', data.NISS || data.niss || '');
    setValue('bi_cc', data.BI || data.bi_cc || '');
    setValue('morada', data.Morada || data.morada || '');
    setValue('contacto', data.Contacto || data.contacto || '');
    setValue('cod_postal', data.Cod_Postal || data.cod_postal || '');
    setValue('data_nasc', data.Data_nasc || data.data_nasc || '');
    setValue('data_admissao', data.Data_Admissao || data.data_admissao || '');
    setValue('data_saida', data.Data_Saida || data.data_saida || '');
    setValue('observacoes', data.Observacao || data.observacoes || '');

    fetch(`/ProjetoEstagio/BackEnd/Beneficiario/Apoios/get_entidades.php`)
        .then(response => response.json())
        .then(entidades => {
            const select = document.getElementById('apoio_entidade');
            if (select) {
                select.innerHTML = '<option value="">Selecione</option>';
                entidades.forEach(entidade => {
                    const option = document.createElement('option');
                    option.value = entidade.id;
                    option.text = entidade.sigla;
                    if (String(entidade.Id_Enti) === String(data.Id_Enti)) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                });
            }
        })
        .catch(() => {
            const select = document.getElementById('apoio_entidade');
            if (select) select.innerHTML = '<option value="">Selecione</option>';
        });

    // Preencher o select de tipo de apoio (tipo_apoio) baseado na entidade selecionada
    if (data.Id_Enti) {
        fetch(`/ProjetoEstagio/BackEnd/Beneficiario/Data/getNomeApoioPorEntidade.php?idEntidade=${data.Id_Enti}&idApoio=${data.Id_Apoio}`)
            .then(response => response.json())
            .then(apoios => {
                const select = document.getElementById('tipo_apoio');
                if (select) {
                    select.innerHTML = '<option value="">Selecione</option>';
                    apoios.forEach(apoio => {
                        const option = document.createElement('option');
                        option.value = apoio.Id_Apoio;
                        option.textContent = apoio.nome;
                        select.appendChild(option);
                    });
                    // Set the selected value after options are added
                    select.value = apoios.find(apoio => apoio.nome)?.Id_Apoio || '';
                }
            })
            .catch(() => {
                const select = document.getElementById('tipo_apoio');
                if (select) select.innerHTML = '<option value="">Selecione</option>';
            });
    }
    setValue('Id_Alimentar', data.Id_Alimentar || '');
    setValue('Id_Sigla', data.Id_Sigla || '');
    setValue('rendimento_per_Capita', data.rendi_Capita || '');
    setValue('SAAS', data.SAAS || '');
    setValue('Id_Titular', data.Id_Titular || '');

    // Checkboxes and radio buttons
    setChecked('deficiencia_sim', data.Incap_Defec === 1);
    setChecked('deficiencia_nao', data.Incap_Defec === 0);

    setChecked('sem_abrigo_sim', data.Sit_sem_abrigo === 1);
    setChecked('sem_abrigo_nao', data.Sit_sem_abrigo === 0);

    setChecked('apoiosaas_sim', data.SAAS === 1);
    setChecked('apoiosaas_nao', data.SAAS === 0);

    setChecked('auto', data.Auto_Depen === 1);
    setChecked('depen', data.Auto_Depen === 0);

    setChecked('Empre', data.Sit_Emprego === 1);
    setChecked('Desemp', data.Sit_Emprego === 0);

    if (data.Imigrante === 1) {
        setChecked('imigrante_sim', true);
        const container = document.getElementById('pais_origem_container');
        if (container) container.style.display = 'block';
        if (data.Id_Sigla) {
            fetch(`/ProjetoEstagio/BackEnd/Beneficiario/paises/getPaisPorId.php?id=${data.Id_Sigla}`)
                .then(response => response.json())
                .then(paisData => {
                    console.log(paisData);
                    setValue('pais_origem_select', paisData || '');
                    const select = document.getElementById('pais_origem_select');
                    if (select) {
                        select.innerHTML = '<option value="">Selecione</option>';
                        paisData.forEach(pais => {
                            const option = document.createElement('option');
                            option.value = pais.Id_Sigla;
                            option.textContent = pais.nome;
                            select.appendChild(option);
                        });
                        // Set the selected value after options are added
                        select.value = paisData.find(pais => pais.nome)?.Id_Sigla || '';
                        
                    
                    }
                })
                .catch(() => {
                    setValue('pais_origem_select', '');
                });
        } else {
            setValue('pais_origem_select', 'Default_Value');
        }
    } else if (data.Imigrante === 0) {
        setChecked('imigrante_nao', true);
        const container = document.getElementById('pais_origem_container');
        if (container) container.style.display = 'none';
    }
}