document.addEventListener("DOMContentLoaded", function () {
  const trigger = document.querySelector(".user-trigger");
  const menu = document.querySelector(".dropdown-menu");

  trigger.addEventListener("click", function (e) {
    e.stopPropagation(); // Important to stop propagation so it doesn’t instantly close
    menu.classList.toggle("show");
  });

  window.addEventListener("click", function (e) {
    if (!e.target.closest('.user-dropdown')) {
      menu.classList.remove("show");
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.contact-bar .dropdown > a').forEach(function(trigger) {
    trigger.addEventListener('click', function(e) {
      e.preventDefault();
      var dropdown = this.parentElement;
      var menu = dropdown.querySelector('.dropdown-content');
      if (menu.style.display === 'block') {
      menu.style.display = 'none';
      dropdown.classList.remove('open');
      } else {
      // Close other dropdowns
      document.querySelectorAll('.contact-bar .dropdown-content').forEach(function(m) {
      m.style.display = 'none';
      m.parentElement.classList.remove('open');
      });
      menu.style.display = 'block';
      dropdown.classList.add('open');
      }
    });
  });
    // Optional: close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.contact-bar .dropdown')) {
      document.querySelectorAll('.contact-bar .dropdown-content').forEach(function(m) {
        m.style.display = 'none';
        m.parentElement.classList.remove('open');
      });
    }
  });
});