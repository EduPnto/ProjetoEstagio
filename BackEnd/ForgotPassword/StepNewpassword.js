function verifyEmail() {
    const email = document.getElementById('email').value;

    if (email) {
      fetch('/ProjetoEstagio/BackEnd/ForgotPassword/verifyEmail.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById('stepEmail').style.display = 'none';
          document.getElementById('stepNewPassword').style.display = 'block';
        } else {
          document.getElementById('errorBox').textContent = data.message;
        }
      })
      .catch(() => {
        document.getElementById('errorBox').textContent = 'Erro ao comunicar com o servidor.';
      });
    } else {
      document.getElementById('errorBox').textContent = 'Por favor, insira um e-mail válido.';
    }
  }

  function updatePassword() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const email = document.getElementById('email').value;

    if (newPassword && confirmPassword) {
      if (newPassword === confirmPassword) {
        fetch('/ProjetoEstagio/BackEnd/ForgotPassword/updatePassword.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ email: email, password: newPassword })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Senha alterada com sucesso.');
            window.location.href = '/ProjetoEstagio/FrontEnd/Paginas/Login/LoginPage.php';
          } else {
            alert(data.message);
          }
        })
        .catch(() => {
          alert('Erro ao tentar alterar a senha.');
        });
      } else {
        alert('As senhas não coincidem.');
      }
    } else {
      alert('Por favor, preencha todos os campos.');
    }
  }