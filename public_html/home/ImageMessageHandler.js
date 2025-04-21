class ImageMessageHandler {
    constructor(captureButtonId, modalId, videoId, canvasId, takePhotoButtonId, messageHubSelector) {
        this.captureButton = document.getElementById(captureButtonId);
        this.modal = document.getElementById(modalId);
        this.video = document.getElementById(videoId);
        this.canvas = document.getElementById(canvasId);
        this.takePhotoButton = document.getElementById(takePhotoButtonId);
        this.messageHub = document.querySelector(messageHubSelector);
        this.stream = null;

        // Adicionar eventos
        this.captureButton.addEventListener('click', () => this.openCamera());
        this.takePhotoButton.addEventListener('click', () => this.captureImage());
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

    async openCamera() {
        try {
            this.stream = await navigator.mediaDevices.getUserMedia({ video: true });
            this.video.srcObject = this.stream;
            $(`#${this.modal.id}`).modal('show');
        } catch (error) {
            console.error('Erro ao acessar a câmera:', error);
        }
    }

    captureImage() {
        const context = this.canvas.getContext('2d');
        this.canvas.width = this.video.videoWidth;
        this.canvas.height = this.video.videoHeight;
        context.drawImage(this.video, 0, 0, this.canvas.width, this.canvas.height);
    
        // Converter a imagem para Blob
        this.canvas.toBlob((imageBlob) => {
            // Capturar a hora atual
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}`;
    
            // Criar elemento para exibir a hora
            const timeElement = document.createElement('div');
            timeElement.classList.add('message-time');
            timeElement.textContent = currentTime;
    
            // Criar elemento para exibir a imagem
            const imgElement = document.createElement('img');
            imgElement.src = URL.createObjectURL(imageBlob);
            imgElement.style.maxWidth = '100%';
            imgElement.style.marginTop = '10px';
    
            // Criar estrutura da mensagem
            const messageContainer = document.createElement('div');
            messageContainer.classList.add('message-container');
    
            const messageBubble = document.createElement('div');
            messageBubble.classList.add('message-bubble');
    
            // Adicionar a imagem e a hora ao bubble
            messageBubble.appendChild(imgElement);
            messageBubble.appendChild(timeElement);
    
            messageContainer.appendChild(messageBubble);
            this.messageHub.appendChild(messageContainer);
    
            // Enviar a imagem para o backend via AJAX
            const formData = new FormData();
            formData.append('image', imageBlob, `image_${Date.now()}.png`);
            formData.append('message', `image_${Date.now()}.png`);
            formData.append('type', 'image');
            formData.append('created_at', this.getDateTimesTamp()); 
    
            $.ajax({
                url: 'dispatch.php?controller=MessageController&&action=persistImage',
                type: 'POST',
                processData: false, // Não processar os dados
                contentType: false, // Deixar o navegador definir o cabeçalho
                data: formData,
                error: () => {
                    // Remover a mensagem em caso de erro no AJAX
                    messageContainer.remove();
                },
                success: (response) => {
                    timeElement.classList.add('message-sent');
                },
            });
    
            // Fechar o modal e parar a câmera
            $(`#${this.modal.id}`).modal('hide');
            this.stream.getTracks().forEach((track) => track.stop());
        }, 'image/png');
    }
}

// Instanciar a classe
const imageMessageHandler = new ImageMessageHandler(
    'capture-image-btn', // ID do botão de captura
    'camera-modal', // ID do modal da câmera
    'camera-stream', // ID do elemento de vídeo
    'camera-canvas', // ID do canvas
    'take-photo-btn', // ID do botão de tirar foto
    '.message-hub' // Seletor do container de mensagens
);