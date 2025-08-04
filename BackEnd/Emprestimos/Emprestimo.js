document.addEventListener("DOMContentLoaded", () => {
    document.getElementById('categoria').addEventListener('change', function () {
        const categoriaId = this.value;

        fetch('/ProjetoEstagio/BackEnd/Produtos/Data/getProdutosEMP.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ categoria: categoriaId })
        })
        .then(response => response.json())
        .then(data => {
            const produtoSelect = document.getElementById('produto');
            produtoSelect.innerHTML = '<option value="">Selecione o produto</option>';
            data.forEach(prod => {
                const opt = document.createElement('option');
                opt.value = prod.Id_Prod;
                opt.textContent = prod.nome_Prod;
                produtoSelect.appendChild(opt);
            });
        });
    });
    
    const nissInput = document.getElementById('niss');
    const nomeInput = document.getElementById('nome');

    nissInput.addEventListener('blur', function () {
        const niss = nissInput.value.trim();

        if (niss.length === 0) return;

        fetch('/ProjetoEstagio/BackEnd/Emprestimos/Data/getBeneficiario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ niss: niss })
        })
        .then(response => response.json())
        .then(data => {
            if (data.nome) {
                nomeInput.value = data.nome;
            } else {
                nomeInput.value = '';
            }
        })
        .catch(error => {
            console.error('Erro ao buscar nome do beneficiário:', error);
        });
    });


    const form = document.getElementById("RegisterForm");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        const data = {
            nome: formData.get("nome"),
            niss: formData.get("niss"),
            produto: formData.get("produto"),
            quantidade: formData.get("quantidade"),
            data_inicio: formData.get("data_inicio"),
            data_entrega: formData.get("data_entrega")
        };

        // Validação básica extra
        if (!data.nome || !data.niss || !data.quantidade || !data.produto || !data.data_inicio || !data.data_entrega) {
            alert("Por favor, preencha todos os campos obrigatórios.");
            return;
        }

        fetch("/ProjetoEstagio/BackEnd/Emprestimos/Criar/CriarEmprestimo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then((res) => res.json())
        .then((resData) => {
            if (resData.success) {
                alert("Empréstimo registado com sucesso!");
                form.reset();
                document.getElementById("produto").innerHTML = '<option value="">Selecione o produto</option>';
            } else {
                alert("Erro ao registar empréstimo:" + (resData.message || "Tente novamente."));
            }
        })
        .catch((err) => {
            console.error("Erro na requisição:", err);
            alert("Erro ao comunicar com o servidor.");
        });
    });
});