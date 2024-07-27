var logoutButton = document.getElementById("logoutButton");
if (logoutButton) {
  logoutButton.addEventListener("click", function (event) {
    event.preventDefault(); // Предотвращаем переход по ссылке по умолчанию
    if (confirm("Вы уверены, что хотите выйти?")) {
      alert("Вы вышли из аккаунта!");
      window.location.href = "logout.php"; // Перенаправляем пользователя на страницу выхода после подтверждения
    }
  });
}
