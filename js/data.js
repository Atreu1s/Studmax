document.getElementById("birthday").addEventListener("input", function (e) {
  let input = e.target.value;
  if (input.length === 2 || input.length === 5) {
    if (input[input.length - 1] !== ".") {
      input += ".";
    }
  }
  document.getElementById("birthday").value = input;
});

document.getElementById("birthday").addEventListener("keydown", function (e) {
  if (e.key === "Backspace") {
    let input = e.target.value;
    if (input.length === 3 || input.length === 6) {
      if (input[input.length - 1] === ".") {
        input = input.slice(0, -1);
      }
    }
    document.getElementById("birthday").value = input;
  }
});
function validateAndSubmit() {
  var inputDate = document.getElementById("birthday").value;
  var dateParts = inputDate.split(".");

  // Проверка на корректность формата даты
  if (dateParts.length !== 3) {
    alert("Неправильный формат даты. Введите дд.мм.гггг");
    return false;
  }

  var day = parseInt(dateParts[0]);
  var month = parseInt(dateParts[1]);
  var year = parseInt(dateParts[2]);

  // Проверка корректности даты
  if (isNaN(day) || isNaN(month) || isNaN(year)) {
    Swal.fire({
      title: "Ошибка",
      text: "Неправильный формат даты. Введите числа в дд.мм.гггг",
      icon: "warning",
    });
    return false;
  }

  // Проверка на максимальный год и минимальный год
  var currentYear = new Date().getFullYear();
  var minYear = currentYear - 8;
  var maxYear = 1960; // Установим максимальный год на 1960

  if (year > minYear || year < maxYear) {
    // Заменяем || на &&
    Swal.fire({
      title: "Ошибка",
      text:
        "Год рождения должен быть в диапазоне от " + maxYear + " до " + minYear,
      icon: "warning",
    });
    return false;
  }

  // Проверка месяца
  if (month < 1 || month > 12) {
    Swal.fire({
      title: "Ошибка",
      text: "Месяц должен быть от 1 до 12",
      icon: "warning",
    });
    return false;
  }

  // Проверка дня
  var daysInMonth = new Date(year, month, 0).getDate();
  if (day < 1 || day > daysInMonth) {
    Swal.fire({
      title: "Ошибка",
      text:
        "Неправильное число для выбранного месяца и года. День должен быть от 1 до " +
        daysInMonth,
      icon: "warning",
    });
    return false;
  }

  // Если все проверки прошли успешно, отправляем форму
  return true;
}
