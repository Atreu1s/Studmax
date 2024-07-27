const regPasswordInput = document.getElementById("regpassword");
const toggleRegPasswordButton = document.getElementById("toggleRegPassword");
const regPasswordCheckInput = document.getElementById("regpassword_check");
const toggleRegPasswordCheckButton = document.getElementById(
  "toggleRegPasswordCheck"
);

toggleRegPasswordButton.addEventListener("click", function () {
  if (regPasswordInput.type === "password") {
    regPasswordInput.type = "text";
    toggleRegPasswordButton.style.backgroundImage =
      "url('img/password-show.svg')";
  } else {
    regPasswordInput.type = "password";
    toggleRegPasswordButton.style.backgroundImage =
      "url('img/password-hide.svg')";
  }
});

toggleRegPasswordCheckButton.addEventListener("click", function () {
  if (regPasswordCheckInput.type === "password") {
    regPasswordCheckInput.type = "text";
    toggleRegPasswordCheckButton.style.backgroundImage =
      "url('img/password-show.svg')";
  } else {
    regPasswordCheckInput.type = "password";
    toggleRegPasswordCheckButton.style.backgroundImage =
      "url('img/password-hide.svg')";
  }
});
const loginPasswordInput = document.getElementById("loginPasswordInput");
const toggleLoginPasswordButton = document.getElementById(
  "toggleLoginPassword"
);

toggleLoginPasswordButton.addEventListener("click", function () {
  if (loginPasswordInput.type === "password") {
    loginPasswordInput.type = "text";
    toggleLoginPasswordButton.style.backgroundImage =
      "url('img/password-show.svg')";
  } else {
    loginPasswordInput.type = "password";
    toggleLoginPasswordButton.style.backgroundImage =
      "url('img/password-hide.svg')";
  }
});

// Для остальных полей ввода и кнопки регистрации
const formFio = document.getElementById("fio");
const formLogin = document.getElementById("login");
const formEmail = document.getElementById("email");
const registerButton = document.getElementById("register_button");
const passwordSpan = document.getElementById("pass_span");
const passwordCheckSpan = document.getElementById("pass_span_check");
const fio_message = document.getElementById("fio_message");

let fioValid = false;
let loginValid = false;
let passwordValid = false;
let emailValid = false;
let passwordMatch = false;

const validateInput = (inputElement, validationFunction) => {
  const inputValue = inputElement.value;
  validationFunction(inputValue, inputElement);
};

const validateFio = (value, inputElement) => {
  const words = value.trim().split(/\s+/);

  if (words.length !== 3 || value.length < 6) {
    fio_message.style.display = "block";
    fio_message.style.color = "red";
    fio_message.innerHTML = "Должно содержать Фамилию Имя Отчество";
    inputElement.style.border = "1px solid red";
    fioValid = false;
  } else {
    fio_message.style.display = "none";
    inputElement.style.border = "1px solid green";
    fioValid = true;
  }
  updateRegisterButton();
};

const validateLogin = (value, inputElement) => {
  if (value.length < 2) {
    inputElement.style.border = "1px solid red";
    loginValid = false;
  } else {
    inputElement.style.border = "1px solid green";
    loginValid = true;
  }
  updateRegisterButton();
};

const validatePassword = (value, inputElement) => {
  const containsUpperCase = /[A-Z]/.test(value);
  const containsLowerCase = /[a-z]/.test(value);
  const containsNumbers = /[0-9]/.test(value);
  const containsSpecialChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(
    value
  );

  let strength = 0;

  if (containsUpperCase) strength++;
  if (containsLowerCase) strength++;
  if (containsNumbers) strength++;
  if (containsSpecialChars) strength++;

  if (value.length < 6 || strength < 3) {
    inputElement.style.border = "1px solid red";
    inputElement.style.color = "red";
    passwordSpan.innerHTML =
      "Простой пароль: Должен содержать более 6 символов и сочетание цифр, букв верхнего и нижнего регистра, а также специальных символов.";
    passwordSpan.style.color = "red";
    passwordValid = false;
  } else {
    inputElement.style.border = "1px solid green";
    inputElement.style.color = "";
    if (strength < 4) {
      passwordSpan.innerHTML =
        "Нормальный пароль: Добавьте буквы верхнего регистра, цифры или специальные символы для улучшения безопасности.";
      passwordSpan.style.color = "orange";
      inputElement.style.border = "1px solid orange";
    } else {
      passwordSpan.innerHTML = "Надежный пароль";
      passwordSpan.style.color = "green";
      inputElement.style.border = "1px solid green";
    }
    passwordValid = true;
  }
  validatePasswordMatch();
  updateRegisterButton();
};

const validatePasswordMatch = () => {
  const password = regPasswordInput.value;
  const passwordCheck = regPasswordCheckInput.value;
  if (password === passwordCheck) {
    regPasswordCheckInput.style.border = "1px solid green";
    passwordMatch = true;
  } else {
    regPasswordCheckInput.style.border = "1px solid red";
    passwordMatch = false;
  }
  updatePasswordCheckSpan();
};

const validateEmail = (value, inputElement) => {
  const email_message = document.getElementById("email_massage");
  if (!value.includes("@") || !value.includes(".")) {
    inputElement.style.border = "1px solid red";
    email_message.style.color = "red";
    email_message.style.display = "block";
    email_message.innerHTML =
      "Почта должна содержать символ '@' и доменное имя, например, example@gmail.com";
    emailValid = false;
  } else {
    inputElement.style.border = "1px solid green";
    email_message.style.display = "none";
    emailValid = true;
  }
  updateRegisterButton();
};

const updateRegisterButton = () => {
  if (
    !fioValid ||
    !loginValid ||
    !passwordValid ||
    !emailValid ||
    !passwordMatch
  ) {
    registerButton.disabled = true;
    registerButton.style.backgroundColor = "gray";
  } else {
    registerButton.disabled = false;
    registerButton.style.backgroundColor = "";
  }
};

const updatePasswordCheckSpan = () => {
  if (!passwordMatch) {
    passwordCheckSpan.innerHTML = "Пароли не совпадают";
    passwordCheckSpan.style.color = "red";
  } else {
    passwordCheckSpan.innerHTML = "";
  }
};

// Назначаем обработчик события для каждого input
formFio.oninput = () => {
  validateInput(formFio, validateFio);
};

formLogin.oninput = () => {
  validateInput(formLogin, validateLogin);
};

regPasswordInput.oninput = () => {
  validateInput(regPasswordInput, validatePassword);
};

regPasswordCheckInput.oninput = () => {
  validatePasswordMatch();
  updatePasswordCheckSpan();
};

formEmail.oninput = () => {
  validateInput(formEmail, validateEmail);
};
