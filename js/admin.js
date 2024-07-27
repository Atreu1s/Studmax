function toggleForm() {
  const vacAddForm = document.getElementById("form_container");

  if (vacAddForm.style.display === "none") {
    vacAddForm.style.display = "block";
  } else {
    vacAddForm.style.display = "none";
  }
}

function toggleNewsletterForm() {
  var formContainer = document.getElementById("newsletterFormContainer");
  // Если форма скрыта, показываем её, иначе скрываем
  if (formContainer.style.display === "none") {
    formContainer.style.display = "block";
  } else {
    formContainer.style.display = "none";
  }
}
// Функция для вывода всех вакансий
function displayVacancies() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        var vacanciesContainer = document.getElementById("vacancies_container");
        vacanciesContainer.innerHTML = ""; // Очистим контейнер перед добавлением новых данных

        var vacancies = JSON.parse(xhr.responseText);
        vacancies.forEach(function (vacancy) {
          var vacancyDiv = document.createElement("div");
          vacancyDiv.innerHTML =
            "<p><strong>ID:</strong> " +
            vacancy.id +
            "</p>" +
            "<p><strong>Компания:</strong> " +
            vacancy.company +
            "</p>" +
            "<p><strong>Название:</strong> " +
            vacancy.title +
            "</p>" +
            "<button onclick='deleteVacancy(" +
            vacancy.id +
            ")'>Удалить</button>";
          vacanciesContainer.appendChild(vacancyDiv);
        });

        vacanciesContainer.style.display = "block";
      } else {
        console.error("Ошибка при получении данных о вакансиях");
      }
    }
  };
  xhr.open("GET", "vendor/get_vacancies.php", true);
  xhr.send();
}

function hideVacancies() {
  document.getElementById("vacancies_container").style.display = "none";
}

function deleteVacancy(vacancyId) {
  confirmAction("Вы уверены? Вы не сможете восстановить эту вакансию!", function () {
      // Если пользователь подтвердил удаление, отправляем запрос на удаление вакансии
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
          if (xhr.readyState == XMLHttpRequest.DONE) {
              if (xhr.status == 200) {
                showModal("Удалено! Вакансия успешно удалена.");
                  // Пример обновления списка вакансий после удаления
                  displayVacancies();
              } else {
                  console.error("Ошибка при удалении вакансии");
              }
          }
      };
      xhr.open("POST", "vendor/delete_vacancy.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("id=" + vacancyId);
  });
}



