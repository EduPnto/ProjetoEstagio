const express = require('express');
const app = express();
const PORT = 3000;

// Middleware para aceitar JSON
app.use(express.json());

app.post('/login', (req, res) => {
  const { name, password } = req.body;

  // Simulação de autenticação (use banco de dados no futuro)
  if (name === 'admin' && password === '1234') {
    res.json({ success: true });
  } else {
    res.json({ success: false, message: 'Credenciais inválidas' });
  }
});

app.listen(PORT, () => {
  console.log(`Servidor rodando na porta ${PORT}`);
});
