// Функция для показа модального окна с сообщением
// Глобальный флаг для хранения состояния подтверждения действия
var confirmedAction = false;

// Функция для показа модального окна с сообщением
function showModal(message) {
    var modal = document.getElementById('myModal');
    var modalText = document.getElementById('modal-text');
    var overlay = document.getElementById("overlay");
    var confirmButton = document.getElementById("confirmButton");

    modalText.textContent = message;
    modal.style.display = 'block';
    overlay.style.display = "block";
    document.body.style.overflow = 'hidden';

    confirmButton.onclick = function () {
        modal.style.display = "none";
        overlay.style.display = "none";
        document.body.style.overflowY = 'auto';
        confirmedAction = true; // Устанавливаем флаг подтверждения действия
        // Выполняем callback, если нужно
        if (typeof callback === 'function') {
            callback();
        }
    };

    window.onclick = function (event) {
        if (event.target == overlay) {
            modal.style.display = 'none';
            overlay.style.display = "none";
            document.body.style.overflowY = 'auto';
            confirmedAction = false; // Сбрасываем флаг при закрытии модального окна без подтверждения
        }
    };
}

// Функция для показа модального окна с подтверждением действия
function confirmAction(message, callback) {
    var modal = document.getElementById("confirmModal");
    var confirmText = document.getElementById("confirm-text");
    var overlay = document.getElementById("overlay");
    var cancelButton = document.getElementById("cancelButton");
    var confirmButton = document.getElementById("confirmButtonConfirm"); // Уникальный id

    confirmText.textContent = message;
    modal.style.display = "block";
    overlay.style.display = "block";
    document.body.style.overflow = 'hidden';

    cancelButton.onclick = function () {
        modal.style.display = "none";
        overlay.style.display = "none";
        document.body.style.overflowY = 'auto';
    };

    confirmButton.onclick = function () {
        modal.style.display = "none";
        overlay.style.display = "none";
        document.body.style.overflowY = 'auto';
        callback();
    };

    window.onclick = function (event) {
        if (event.target == overlay) {
            modal.style.display = "none";
            overlay.style.display = "none";
            document.body.style.overflowY = 'auto';
        }
    };
}