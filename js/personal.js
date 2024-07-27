document.addEventListener("DOMContentLoaded", function (event) {
  let circle = document.querySelectorAll(".circle");
  circle.forEach(function (progress) {
    let degree = 0;
    let targetDegree = parseInt(progress.getAttribute("data-degree"));
    let color = progress.getAttribute("data-color");

    var interval = setInterval(function () {
      degree += 1;
      if (degree > targetDegree) {
        clearInterval(interval);
        return;
      }
      progress.style.background =
        "conic-gradient(#353d60 " + degree + "%, white 0%)";
    }, 10);
  });
});
document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("DOMContentLoaded", function () {
    var birthdayInput = document.getElementById("birthday");

    // Устанавливаем минимальное значение для даты в поле ввода
    var minDate = "1950-01-01";
    birthdayInput.setAttribute("min", minDate);

    // Устанавливаем максимальное значение для даты в поле ввода
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var currentMonth = ("0" + (currentDate.getMonth() + 1)).slice(-2); // Добавляем ведущий ноль для однозначных месяцев
    var currentDay = ("0" + currentDate.getDate()).slice(-2); // Добавляем ведущий ноль для однозначных дней
    var maxDate = currentYear + "-" + currentMonth + "-" + currentDay;
    birthdayInput.setAttribute("max", maxDate);
  });
});

function showEditForm(section) {
  // Показываем форму редактирования
  document.getElementById("edit_" + section + "_form").style.display = "block";
}
document.addEventListener("DOMContentLoaded", function () {
  var personalImg = document.querySelector(".personal_img");
  personalImg.addEventListener("click", function () {
    document.getElementById("fileInput").click();
    document.getElementById("profile_change_img").style.display = "block";
  });
});
// function showEditForm(section) {
//   // Показываем форму редактирования
//   document.getElementById("edit_form").style.display = "block";
//   // Очищаем текстовое поле формы
//   document.getElementById("edit_text").value = "";
//   // Устанавливаем данные, если они уже были заполнены
//   var content = document.getElementById(section + "_content").innerText;
//   document.getElementById("edit_text").value = content;
//   // Устанавливаем data-атрибут, чтобы позже определить, какую секцию обновлять
//   document.getElementById("edit_form").setAttribute("data-section", section);
// }
function toggleEdit() {
  var inputField = document.getElementById("user_description_input");
  var saveButton = document.getElementById("save_button");

  inputField.removeAttribute("disabled");
  saveButton.style.display = "block";
}

// function saveDescription() {
//   var inputField = document.getElementById("user_description_input");
//   var saveButton = document.getElementById("save_button");

//   inputField.setAttribute("disabled", true);
//   saveButton.style.display = "none";
//   return true; // Вернуть true для отправки формы
// }

function toggleEditSkills() {
  var inputField = document.getElementById("user_skills_input");
  var saveButton = document.getElementById("save_skills_button");

  inputField.removeAttribute("disabled");
  saveButton.style.display = "block";
}
// Функция для автоматического увеличения высоты textarea
function autoResizeTextarea() {
  var textarea = document.getElementById("user_description_input");
  textarea.style.height = ""; // Сбрасываем высоту до авто

  // Устанавливаем новую высоту на основе прокрутки содержимого
  textarea.style.height = textarea.scrollHeight + "px";
}

// Вызываем функцию при загрузке страницы, чтобы установить правильную высоту textarea
window.addEventListener("load", autoResizeTextarea);
