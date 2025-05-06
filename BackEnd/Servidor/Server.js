const express = require('express');
const nodemailer = require('nodemailer');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const crypto = require('crypto');

const app = express();
const port = 3000;

app.use(bodyParser.json());

// Configuração do banco de dados MySQL
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',  // Senha do MySQL (geralmente em XAMPP é vazio)
  database: 'clis_db'  // Nome do seu banco de dados
});

// Conectar ao banco de dados
db.connect(err => {
  if (err) {
    console.error('Erro ao conectar no banco de dados:', err);
    return;
  }
  console.log('Conectado ao banco de dados.');
});

// Função para gerar o código de recuperação
function generateRecoveryCode() {
  return crypto.randomInt(100000, 999999).toString();  // Gera um código de 6 dígitos
}

// Enviar o código para o e-mail
app.post('/send-code', (req, res) => {
  const { email } = req.body;
  const recoveryCode = generateRecoveryCode();

  // Enviar e-mail usando Nodemailer
  const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: 'seu_email@gmail.com',  // Substitua com o seu e-mail
      pass: 'sua_senha'  // Substitua com a sua senha
    }
  });

  const mailOptions = {
    from: 'seu_email@gmail.com',
    to: email,
    subject: 'Código de Recuperação de Senha',
    text: `Seu código de recuperação de senha é: ${recoveryCode}`
  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      return res.json({ success: false, message: 'Erro ao enviar o código de recuperação.' });
    }

    // Armazene o código gerado para validação futura
    db.query('UPDATE users SET recovery_code = ? WHERE email = ?', [recoveryCode, email], (err, result) => {
      if (err) {
        return res.json({ success: false, message: 'Erro ao armazenar código no banco.' });
      }

      return res.json({ success: true, message: 'Código enviado com sucesso.' });
    });
  });
});

// Verificar o código
app.post('/verify-code', (req, res) => {
  const { email, code } = req.body;

  // Verificar se o código recebido corresponde ao código armazenado no banco
  db.query('SELECT recovery_code FROM users WHERE email = ?', [email], (err, result) => {
    if (err) {
      return res.json({ success: false, message: 'Erro ao verificar código.' });
    }

    if (result.length === 0 || result[0].recovery_code !== code) {
      return res.json({ success: false, message: 'Código inválido.' });
    }

    return res.json({ success: true, message: 'Código verificado com sucesso.' });
  });
});

// Atualizar a senha
app.post('/update-password', (req, res) => {
  const { email, newPassword } = req.body;

  // Atualizar a senha no banco de dados
  db.query('UPDATE users SET password = ? WHERE email = ?', [newPassword, email], (err, result) => {
    if (err) {
      return res.json({ success: false, message: 'Erro ao atualizar a senha.' });
    }

    return res.json({ success: true, message: 'Senha atualizada com sucesso.' });
  });
});

// Iniciar o servidor
app.listen(port, () => {
  console.log(`Servidor rodando em http://localhost:${port}`);
});