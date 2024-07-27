document.addEventListener("DOMContentLoaded", function () {
  var birthdayInput = document.getElementById("birthday");

  // Функция для установки маски ввода и проверки даты
  function setMask() {
    var value = this.value.replace(/\D/g, ""); // Удаляем все нечисловые символы
    var formattedValue = formatDateString(value);

    this.value = formattedValue;
  }

  // Функция для форматирования строки даты
  function formatDateString(value) {
    var day = value.slice(0, 2);
    var month = value.slice(2, 4);
    var year = value.slice(4, 6);

    if (day && month && year) {
      // Проверяем корректность даты
      if (!isValidDate(parseInt(day), parseInt(month), parseInt(year))) {
        // Преобразуем строки в числа
        alert("Введите корректную дату (дд-мм-гг)");
        return "";
      }

      // Форматируем строку даты в формат "dd-mm-yy"
      return day + "-" + month + "-" + year;
    }

    return value;
  }

  // Функция для проверки корректности даты
  function isValidDate(day, month, year) {
    var date = new Date(year, month - 1, day); // Месяцы в JavaScript начинаются с 0

    // Проверяем, является ли полученная дата корректной
    return (
      date.getDate() == day &&
      date.getMonth() + 1 == month &&
      date.getFullYear() == year
    );
  }

  // Применяем маску ввода и проверку даты при изменении значения поля
  birthdayInput.addEventListener("input", setMask);

  // Обработчик события отправки формы
  document.querySelector("form").addEventListener("submit", function () {
    // Перед отправкой формы меняем тип поля ввода на "date"
    birthdayInput.type = "date";
  });
});
