const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const PORT = 3000;

app.use(cors());
app.use(bodyParser.json());

const fakeUser = {
  name: 'admin',
  password: '1234'
};

app.post('/login', (req, res) => {
  const { name, password } = req.body;

  if (name === 'admin' && password === '1234') {
    res.json({ success: true, message: 'Login bem-sucedido!' });
  } else {
    res.json({ success: false, message: 'Nome ou senha incorretos.' });
  }
});

app.listen(PORT, () => {
  console.log(`Servidor rodando em http://localhost:${PORT}`);
});
