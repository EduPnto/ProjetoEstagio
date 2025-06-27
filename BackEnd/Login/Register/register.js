document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('RegisterForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(registerForm);

            fetch('/ProjetoEstagio/BackEnd/Login/Register/RegisterAccount.php', {
                method: 'POST',
                body: formData
            })
            .then(async response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.indexOf('application/json') !== -1) {
                    return response.json();
                } else {
                    const text = await response.text();
                    throw new Error('Resposta inesperada do servidor: ' + text);
                }
            })
            .then(data => {
                if (data.success) {
                    window.location.replace('/ProjetoEstagio/FrontEnd/Paginas/MainPage/MainPage.php');
                } else {
                    alert(data.message || 'Registo falhou.');
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert('Erro na requisição: ' + error.message);
            });
        });
    } else {
        console.error("RegisterForm element not found.");
    }
});

function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('foto_perfil_preview');
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