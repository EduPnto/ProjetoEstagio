let userEmail = '';
let validCode = '123456';

// Enviar código para o e-mail
function sendRecoveryCode() {
  userEmail = document.getElementById('email').value;

  if (!userEmail) {
    alert('Por favor, digite seu e-mail.');
    return;
  }

  // Chama a API do backend para enviar o código
  fetch('http://localhost:3000/send-code', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ email: userEmail })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert(`Código enviado para ${userEmail}.`);
      document.getElementById('stepEmail').style.display = 'none';
      document.getElementById('stepCode').style.display = 'block';
    } else {
      alert(data.message);
    }
  })
  .catch(error => alert('Erro ao enviar código.'));
}

// Verificar código
function verifyCode() {
  const codeInput = document.getElementById('code').value;

  fetch('http://localhost:3000/verify-code', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ email: userEmail, code: codeInput })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      document.getElementById('stepCode').style.display = 'none';
      document.getElementById('stepNewPassword').style.display = 'block';
    } else {
      alert(data.message);
    }
  })
  .catch(error => alert('Erro ao verificar código.'));
}

// Atualizar senha
function updatePassword() {
  const newPass = document.getElementById('newPassword').value;
  const confirmPass = document.getElementById('confirmPassword').value;

  if (newPass !== confirmPass) {
    alert('As senhas não coincidem!');
    return;
  }

  // Chama a API do backend para atualizar a senha
  fetch('http://localhost:3000/update-password', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ email: userEmail, newPassword: newPass })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Senha alterada com sucesso!');
      window.location.href = '../LoginPage.php';
    } else {
      alert(data.message);
    }
  })
  .catch(error => alert('Erro ao atualizar senha.'));
}
