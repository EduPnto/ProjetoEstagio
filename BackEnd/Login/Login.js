document.getElementById('loginForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const name = document.getElementById('name').value;
  const password = document.getElementById('password').value;

  fetch('../../../BackEnd/Login/LoginVerify.php', { // Caminho para o novo ficheiro PHP
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `name=${encodeURIComponent(name)}&password=${encodeURIComponent(password)}`
  })

  .then(response => response.json())
  .then(data => {
    console.log(data); // <-- Vê o que está a chegar
    if (data.success) {
      alert('Login bem-sucedido!');
      window.location.href = 'Paginas/MainPage.php';
    } else {
      alert(data.message);
    }
})
  .catch(error => console.error('Erro na requisição:', error));
});
