class AudioMessage {
  constructor(
    recordButtonId,
    stopButtonId,
    timerDisplayId,
    messageHubSelector
  ) {
    this.mediaRecorder = null;
    this.audioChunks = [];
    this.timerInterval = null;
    this.seconds = 0;

    // Elementos DOM
    this.recordButton = document.getElementById(recordButtonId);
    this.stopButton = document.getElementById(stopButtonId);
    this.timerDisplay = document.getElementById(timerDisplayId);
    this.messageHub = document.querySelector(messageHubSelector);

    // Adicionar eventos
    this.recordButton.addEventListener("click", () => this.startRecording());
    this.stopButton.addEventListener("click", () => this.stopRecording());
  }

  getDateTimesTamp(){
    const now = new Date()
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, "0"); // + 1 para Corrigir o mês 0 indexado
    const day = String(now.getDate()).padStart(2, "0");
    const date = `${year}-${month}-${day}`;
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const seconds = String(now.getSeconds()).padStart(2, "0");
    return `${date} ${hours}:${minutes}:${seconds}`;
  }

  // Método para iniciar a gravação
  async startRecording() {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    this.mediaRecorder = new MediaRecorder(stream);

    this.mediaRecorder.start();
    this.recordButton.style.display = "none";
    this.stopButton.style.display = "block";
    this.timerDisplay.style.display = "block";

    // Adicionar a classe de animação ao botão de parar
    this.stopButton.classList.add("pulsing");

    // Iniciar o contador de tempo
    this.seconds = 0;
    this.timerDisplay.textContent = "00:00";
    this.timerInterval = setInterval(() => {
      this.seconds++;
      const minutes = Math.floor(this.seconds / 60);
      const remainingSeconds = this.seconds % 60;
      this.timerDisplay.textContent = `${String(minutes).padStart(
        2,
        "0"
      )}:${String(remainingSeconds).padStart(2, "0")}`;
    }, 1000);

    // Capturar os dados de áudio
    this.mediaRecorder.ondataavailable = (event) => {
      this.audioChunks.push(event.data);
    };

    // Quando a gravação parar
    this.mediaRecorder.onstop = () => this.handleRecordingStop();
  }

  // Método para parar a gravação
  stopRecording() {
    this.mediaRecorder.stop();
    clearInterval(this.timerInterval); // Parar o contador
    this.timerDisplay.style.display = "none"; // Ocultar o contador
  }

  // Método para lidar com o término da gravação
  handleRecordingStop() {
    clearInterval(this.timerInterval); // Parar o contador
    this.timerDisplay.style.display = "none"; // Ocultar o contador

    const audioBlob = new Blob(this.audioChunks, { type: "audio/mpeg" });
    const audioUrl = URL.createObjectURL(audioBlob);

    // Criar elemento de áudio
    const audioElement = document.createElement("audio");
    audioElement.controls = true;
    audioElement.src = audioUrl;

    // Capturar a hora atual
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const currentTime = `${hours}:${minutes}`;

    // Criar elemento para exibir a hora
    const timeElement = document.createElement("div");
    timeElement.classList.add("message-time");
    timeElement.textContent = currentTime;

    // Criar estrutura da mensagem
    const messageContainer = document.createElement("div");
    messageContainer.classList.add("message-container");

    const messageBubble = document.createElement("div");
    messageBubble.classList.add("message-bubble");

    // Adicionar o áudio e a hora ao bubble
    messageBubble.appendChild(audioElement);
    messageBubble.appendChild(timeElement);

    messageContainer.appendChild(messageBubble);
    this.messageHub.appendChild(messageContainer);

    // Resetar variáveis e botões
    this.audioChunks = [];
    this.recordButton.style.display = "block";
    this.stopButton.style.display = "none";

    // Remover a classe de animação do botão de parar
    this.stopButton.classList.remove("pulsing");

    const formData = new FormData();
    const audioFileName = `audio_${Date.now()}.mp3`;
    formData.append("audio", audioBlob, audioFileName);
    formData.append("message", audioFileName);
    formData.append("type", "audio");
    formData.append("created_at", this.getDateTimesTamp()); 

    $.ajax({
      url: "dispatch.php?controller=MessageController&&action=persistAudio",
      type: "POST",
      processData: false,
      contentType: false,
      data: formData,
      error: () => {
        messageContainer.remove();
      },
      success: (response) => {
        timeElement.classList.add("message-sent");
      }
    });
  }
}

// Instanciar a classe
const audioMessage = new AudioMessage(
  "record-audio-btn", // ID do botão de gravação
  "stop-audio-btn", // ID do botão de parar
  "record-timer", // ID do display do timer
  ".message-hub" // Seletor do container de mensagens
);
