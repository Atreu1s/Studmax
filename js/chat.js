$(document).ready(function() {
  $('#sendMessageForm').submit(function(event) {
      event.preventDefault();
      
      $.ajax({
          type: 'POST',
          url: '../vendor/send_message.php',
          data: $(this).serialize(),
          success: function(response) {
              $('#sendMessageForm textarea').val(''); // Очистка текстовой области
              loadMessages(); // Обновление списка сообщений
          },
          error: function() {
              alert('Ошибка при отправке сообщения.');
          }
      });
  });

  function loadMessages() {
      var chat_id = $('input[name="chat_id"]').val();
      $.ajax({
          url: '../vendor/load_messages.php',
          type: 'GET',
          data: { chat_id: chat_id },
          success: function(data) {
              $('.messages').html(data);
              scrollToBottom();
          },
          error: function() {
              alert('Ошибка загрузки сообщений.');
          }
      });
  }
  function scrollToBottom() {
    var messages = $('.messages');
    messages.scrollTop(messages.prop("scrollHeight"));
}
  // Загружаем сообщения при загрузке страницы
  loadMessages();

  // Автоматически обновляем сообщения каждые 5 секунд
  setInterval(loadMessages, 5000);
});
