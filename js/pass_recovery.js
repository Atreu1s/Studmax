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

// Для остальных полей ввода и кнопки регистрации

const passwordSpan = document.getElementById("pass_span");
const passwordCheckSpan = document.getElementById("pass_span_check");

const validateInput = (inputElement, validationFunction) => {
  const inputValue = inputElement.value;
  validationFunction(inputValue, inputElement);
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

const updatePasswordCheckSpan = () => {
  if (!passwordMatch) {
    passwordCheckSpan.innerHTML = "Пароли не совпадают";
    passwordCheckSpan.style.color = "red";
  } else {
    passwordCheckSpan.innerHTML = "";
  }
};

// Назначаем обработчик события для каждого input

regPasswordInput.oninput = () => {
  validateInput(regPasswordInput, validatePassword);
};

regPasswordCheckInput.oninput = () => {
  validatePasswordMatch();
  updatePasswordCheckSpan();
};
