const navToggle = document.querySelector(".nav__toggle");
const navMenu = document.querySelector(".nav__menu");
const tipButtons = document.querySelectorAll(".tip");
const tipMessage = document.querySelector("#tip-message");

navToggle.addEventListener("click", () => {
  const isOpen = navMenu.classList.toggle("is-open");
  navToggle.setAttribute("aria-expanded", String(isOpen));
});

navMenu.addEventListener("click", (event) => {
  if (event.target.matches("a")) {
    navMenu.classList.remove("is-open");
    navToggle.setAttribute("aria-expanded", "false");
  }
});

tipButtons.forEach((button) => {
  button.addEventListener("click", () => {
    tipButtons.forEach((item) => item.classList.remove("is-active"));
    button.classList.add("is-active");
    tipMessage.textContent = button.dataset.tip;
  });
});
