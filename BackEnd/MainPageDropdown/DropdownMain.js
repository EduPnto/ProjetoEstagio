function toggleDropdown() {
    const menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
  }

  // Fecha o dropdown se clicar fora dele
  window.onclick = function(event) {
    if (!event.target.closest('.user-dropdown')) {
      const dropdown = document.getElementById("dropdownMenu");
      if (dropdown) dropdown.style.display = "none";
    }
  }