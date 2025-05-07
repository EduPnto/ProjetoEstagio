document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.querySelector('.user-trigger');
    const menu = document.querySelector('.dropdown-menu');

    trigger.addEventListener('click', function() {
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    });

    window.addEventListener('click', function(e) {
      if (!trigger.contains(e.target)) {
        menu.style.display = 'none';
      }
    });
    });