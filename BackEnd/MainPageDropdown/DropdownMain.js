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
