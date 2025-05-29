document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('RegisterForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = document.getElementById('RegisterForm');
    const formData = new FormData(form);

    fetch('<?php echo BASE_URL; ?>BackEnd/Login/Register/RegisterAccount.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
        window.location.replace('<?php echo BASE_URL; ?>FrontEnd/Paginas/MainPage/MainPage.php');
        } else {
        alert(data.message || 'Registo falhou.');
        }
    })
    .catch(error => console.error('Erro na requisição:', error));
    });
});
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('foto_perfil_preview');
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