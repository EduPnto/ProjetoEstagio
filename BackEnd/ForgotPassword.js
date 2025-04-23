const express = require('express');
const app = express();
const PORT = 3001;

// Middleware para aceitar JSON
app.use(express.json());

// Mock para envio de código por e-mail
app.post('/send-code', (req, res) => {
  const { email } = req.body;

  if (email === 'user@example.com') {
    const code = '123456';  // Mock do código de recuperação
    res.json({ success: true, code });
  } else {
    res.json({ success: false, message: 'E-mail não encontrado.' });
  }
});

// Mock para validar o código
app.post('/verify-code', (req, res) => {
  const { email, code } = req.body;

  if (code === '123456') {
    res.json({ success: true });
  } else {
    res.json({ success: false, message: 'Código inválido' });
  }
});

// Mock para atualização de senha
app.post('/update-password', (req, res) => {
  const { email, newPassword } = req.body;

  // Aqui você vai conectar com o banco de dados para atualizar a senha real
  res.json({ success: true, message: 'Senha alterada com sucesso!' });
});

app.listen(PORT, () => {
  console.log(`Servidor de recuperação de senha rodando na porta ${PORT}`);
});
