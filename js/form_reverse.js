const regInfo = document.getElementById("regInfo");
const regForm = document.getElementById("regForm");
const loginBtn = document.getElementById("loginBtn");
// ! разделения ра 2 формы
const regBtn = document.getElementById("regBtn");
const logForm = document.getElementById("logForm");
const logInfo = document.getElementById("logInfo");

loginBtn.addEventListener("click", () => {
  regInfo.classList.add("reverse_form");
  regForm.classList.add("reverse_form");
  logInfo.style.display = "block";
  logForm.style.display = "block";

  setTimeout(() => {
    logInfo.classList.add("reverse_form_active");
    logForm.classList.add("reverse_form_active");
  }, 1000);
  setTimeout(() => {
    regInfo.style.display = "none";
    regForm.style.display = "none";
  }, 2000);
});

regBtn.addEventListener("click", () => {
  logInfo.classList.remove("reverse_form_active");
  logForm.classList.remove("reverse_form_active");
  logInfo.classList.add("reverse_form");
  logInfo.classList.add("reverse_form");
  regInfo.style.display = "block";
  regForm.style.display = "block";

  setTimeout(() => {
    regInfo.classList.add("reverse_form_active");
    regForm.classList.add("reverse_form_active");
    regInfo.classList.remove("reverse_form");
    regForm.classList.remove("reverse_form");
  }, 1000);
  setTimeout(() => {
    regInfo.classList.remove("reverse_form_active");
    regForm.classList.remove("reverse_form_active");
    logInfo.style.display = "none";
    logForm.style.display = "none";
  }, 2000);
});
