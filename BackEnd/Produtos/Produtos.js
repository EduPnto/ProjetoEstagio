document.addEventListener('DOMContentLoaded', function() {
    fetch('/ProjetoEstagio/BackEnd/Entidade/get_entidades.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('apoio_entidade');
            select.innerHTML = '<option value="">Selecione a entidade</option>';
            data.forEach(fornecedor => {
                const opt = document.createElement('option');
                opt.value = fornecedor.Id_Enti;
                opt.textContent = fornecedor.Sigla;
                select.appendChild(opt);
            });
        });

    const registerForm = document.getElementById('RegisterForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(registerForm);
            
            fetch('/ProjetoEstagio/BackEnd/Produtos/AddProdutos.php', {
                method: 'POST',
                body: formData
            })
            .then(async response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.indexOf('application/json') !== -1) {
                    return response.json();
                }
            })
            .then(data => {
                if (data.success) {
                    window.location.replace('/ProjetoEstagio/FrontEnd/Paginas/MainPage/MainPage.php');
                } else {
                    alert(data.message || 'Registo falhou.');
                }
            })
        });
    } else {
        console.error("RegisterForm element not found.");
    }
});

function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('foto_prod_preview');
    if (!preview) {
        console.error("Preview image element not found.");
        return;
    }
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}