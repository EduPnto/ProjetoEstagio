document.getElementById("loginForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    const name = document.getElementById("name").value;
    const password = document.getElementById("password").value;
  
    const response = await fetch('http://localhost:3000/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ name, password })
    });
  
    const data = await response.json();
  
    if (data.success) {
      // Redireciona para a página principal
      window.location.href = "../Páginas/MainPage.html";
    } else {
      alert(data.message);
    }
  });