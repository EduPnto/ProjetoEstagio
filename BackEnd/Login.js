const express = require('express');
const app = express();
const PORT = 3000;

document.getElementById('loginForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const name = document.getElementById('name').value;
  const password = document.getElementById('password').value;

  const response = await fetch('/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ name, password })
  });

  const data = await response.json();
  
  if (name === 'admin' && password === '1234') {
    res.json({ success: true });

    if (data.success) {
      window.location.href = '../FrontEnd/Páginas/MainPage.php'; // Redirecionamento feito no cliente
    }
  } else {
    alert('Credenciais inválidas');
  }
});
