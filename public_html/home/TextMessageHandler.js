class TextMessageHandler {
    constructor(sendButtonId, textAreaId, messageHubSelector) {
      this.sendMessageButton = document.getElementById(sendButtonId);
      this.textArea = document.getElementById(textAreaId);
      this.messageHub = document.querySelector(messageHubSelector);
  
      // Adicionar evento ao botão de envio
      this.sendMessageButton.addEventListener("click", () => this.sendMessage());
    }
  
    // Método para capturar a hora atual
    getCurrentTime() {
      const now = new Date();
      const hours = String(now.getHours()).padStart(2, "0");
      const minutes = String(now.getMinutes()).padStart(2, "0");
      return `${hours}:${minutes}`;
    }
  
    // Método para criar e exibir a mensagem
    createMessageElement(messageText) {
      const currentTime = this.getCurrentTime();
  
      // Criar elemento para exibir a hora
      const timeElement = document.createElement("div");
      timeElement.classList.add("message-time");
      timeElement.textContent = currentTime;
  
      // Criar elemento para exibir a mensagem
      const messageElement = document.createElement("div");
      messageElement.classList.add("message-text", "message-pending"); // Adicionar classe inicial (cinza)
      messageElement.textContent = messageText;
  
      // Criar estrutura da mensagem
      const messageContainer = document.createElement("div");
      messageContainer.classList.add("message-container");
  
      const messageBubble = document.createElement("div");
      messageBubble.classList.add("message-bubble");
  
      // Adicionar o texto e a hora ao bubble
      messageBubble.appendChild(messageElement);
      messageBubble.appendChild(timeElement);
  
      messageContainer.appendChild(messageBubble);
      this.messageHub.appendChild(messageContainer);
  
      return { messageContainer, messageElement };
    }
  
    // Método para enviar a mensagem
    sendMessage() {
      const messageText = this.textArea.value.trim();
  
      if (messageText === "") {
        return; // Não enviar mensagens vazias
      }
  
      // Criar e exibir a mensagem
      const { messageContainer, messageElement } = this.createMessageElement(messageText);
  
      // Limpar o textarea
      this.textArea.value = "";
  
      // Enviar a mensagem via AJAX
      $.ajax({
        url: "dispatch.php?controller=MessageController&&action=create",
        type: "POST",
        data: {
          message: messageText,
          type: 'text',
          created_at: "2025-01-16",
        },
        success: (response) => {
          messageElement.classList.remove("message-pending");
          messageElement.classList.add("message-sent");
        },
        error: () => {
          messageContainer.remove();
        },
      });
    }
  }
  
  const textMessageHandler = new TextMessageHandler(
    "send-message-btn", // ID do botão de envio
    "text_message", // ID do textarea
    ".message-hub" // Seletor do container de mensagens
  );