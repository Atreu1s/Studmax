document.addEventListener("DOMContentLoaded", function () {
  var deleteButton = document.getElementById("deleteButton");
  if (deleteButton) {
    deleteButton.addEventListener("click", function (event) {
      event.preventDefault();
      if (confirm("Вы уверены, что хотите удалить аккаунт?")) {
        if (confirm("Подтвердите удаление")) {
          document.getElementById("deleteForm").submit();
        }
      }
    });
  }
});
