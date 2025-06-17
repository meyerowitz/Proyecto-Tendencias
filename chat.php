<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        html, body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            padding:0;
            width: 100%;
            height: 100%;
        }

        .chat-container {
            width: 100%;
            height:100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            overflow: hidden;
        }
        
        /* Contenedor del canvas del robot, ahora para CADA mensaje del bot */
        .robot-avatar-container {
            background-color: cyan;
            border-radius:100px;
            width: 60px;
            height:60px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            border: 3px solid blue;
            margin-right: -15px;
            margin-top: -9px;
            z-index: 1; /* Asegura que esté por encima de la burbuja */
        }

        .robot-avatar-container canvas {
            width:100%;
            height:150%;
        }

         .avatar-container {
            background-color: white;
            border-radius:100px;
            width: 60px;
            height:60px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            border: 3px solid blue;
            margin-left: -15px;
            margin-top: -9px;
            overflow:hidden;
            z-index: 1; 
            align-items: center;
            justify-content: center;
        }
        
        

        .chat-header {
            background: linear-gradient(to right,rgb(56, 119, 254),rgb(107, 230, 255));
            color: white;
            padding: 30px;
            padding-left:50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; /* Keep header visible */
            top: 0;
            z-index: 10;
        }

        .chat-header .left {
            display: flex;
            align-items: center;

        }

        .chat-header .left .material-icons {
            margin-right: 10px;
            font-size: 24px;
        }

        .chat-header .right .material-icons {
            margin-left: 15px;
            font-size: 24px;
        }

        a{
            text-decoration: none;
        }
        .chat-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            padding-bottom: 20px; /* Space for the last message */
            text-align: right;
        }

        .message-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 15px;
            position: relative; /* For time positioning */
        }

        .message-row.sent {
            justify-content: flex-end;
        }

        .message-row.received {
            justify-content: flex-start;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 10px;
            flex-shrink: 0; /* Prevent avatar from shrinking */
        }

        .message-bubble {
            padding: 1% 1.5%;
            border-radius: 20px;
            min-width: 10%;
            max-width: 55%;
            word-wrap: break-word;
            display: flex;
            align-items: center;
            line-height: 1.4;
        }

        /* CORRECTED STYLES: Received messages are now colorful */
        .message-bubble.received {
            background: linear-gradient(to right,rgb(19, 65, 165),rgb(6, 172, 206));
            color: white;
            border-bottom-left-radius: 5px;
            text-align: right;
        }

        /* CORRECTED STYLES: Sent messages are now white */
        .message-bubble.sent {
            background-color: #f1f0f0; /* Or #fff with a subtle border if preferred */
            color: #333;
            border-bottom-right-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; /* Optional: subtle shadow for white bubble */
            text-align: right;
        }

        .message-time {
            font-size: 0.75em;
            color: #888;
            position: absolute;
            white-space: nowrap;
        }

        .message-row.sent .message-time {
            left: -55px; /* Position time to the left of the bubble */
            top: 50%;
            transform: translateY(-50%);
        }

        .message-row.received .message-time {
            right: -55px; /* Position time to the right of the bubble */
            top: 50%;
            transform: translateY(-50%);
        }

        /* Specific styles for message types */
        .message-bubble img {
            max-width: 100%;
            border-radius: 10px;
            display: block; /* Remove extra space below image */
        }

        .message-bubble .emoji-container {
            display: flex;
            font-size: 1.5em; /* Larger emojis */
        }

        .audio-player {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .audio-player .play-button {
            background-color: white; /* Button is white for pink bubble */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            flex-shrink: 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .audio-player .play-button .material-icons {
            color: #ff4757; /* Icon color for play button */
            font-size: 20px;
        }

        .audio-player .progress-bar-container {
            flex-grow: 1;
            height: 6px;
            background-color: rgba(255, 255, 255, 0.5); /* Lighter white for progress bar */
            border-radius: 3px;
            position: relative;
        }

        .audio-player .progress-bar {
            height: 100%;
            width: 50%; /* Example progress */
            background-color: white; /* Progress fill is white */
            border-radius: 3px;
        }

        .audio-player .time-display {
            font-size: 0.8em;
            margin-left: 10px;
            color: white;
        }

        .chat-input {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-top: 1px solid #eee;
            background-color: #fff;
            position: sticky; /* Keep input visible */
            bottom: 0;
            z-index: 10;
        }

        .chat-input .material-icons.add-icon {
            color: #ff4757;
            background-color: #ffe0e6; /* Lighter pink for the plus circle */
            border-radius: 50%;
            padding: 5px;
            margin-right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .chat-input input {
            flex-grow: 1;
            border: none;
            padding: 10px;
            border-radius: 20px;
            background-color: #f1f0f0;
            outline: none;
            font-size: 1em;
            color: #333;
        }

        .chat-input .send-button {
            background: linear-gradient(to right, #ff6b81, #ff4757);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            border: none; /* Asegura que no tenga borde de botón por defecto */
            padding: 0; /* Elimina padding por defecto del botón */
        }

        .chat-input .send-button .material-icons {
            color: white;
        }

        /* Estilos para los comentarios y el "pensando..." */
        .thinking-dots {
            display: inline-block;
            overflow: hidden;
            vertical-align: bottom;
            animation: thinking-dots-animation 1.2s infinite steps(4, end);
            width: 25px; /* Ajusta el ancho para que los puntos no salten */
        }

        @keyframes thinking-dots-animation {
            0% { width: 0; }
            25% { width: 5px; } /* Un punto */
            50% { width: 10px; } /* Dos puntos */
            75% { width: 15px; } /* Tres puntos */
            100% { width: 20px; } /* Espacio para el cuarto si se usa, o resetea */
        }
    </style>
</head>
<body>

    <div class="chat-container">
        <div class="chat-header">
            <div class="left">
                <i class="material-icons">arrow_back</i>
                <span>Rebeca jr</span>
            </div>
            <div class="right">
                <i class="material-icons">search</i>
                <i class="material-icons">more_vert</i>
            </div>
        </div>

        <div class="chat-messages">
        </div>

        <div class="chat-input">
            <i class="material-icons add-icon">add</i>
            <input type="text" id="messageInput" placeholder="Your message...">
            <button id="sendButton" class="send-button"> 
                <i class="material-icons">send</i>
            </button>
        </div>
    </div>
    
    <script src="./Scripts/three.min.js"></script>
    <script src="./Scripts/GLTFLoader.js"></script>
    <script src="./Scripts/tween.umd.min.js"></script>
    <script src="./Scripts/cargarCabeza.js"></script>

    <script>
        // --- Manejo de Múltiples Instancias del Robot 3D ---
        // Almacenamos las referencias a las instancias de los robots para poder llamar a dispose()
        const robotInstances = new WeakMap(); // Almacena {canvasElement -> {dispose, stop, ...}}

        /**
         * Inicializa la escena 3D del robot en un canvas específico utilizando cargarCabeza2.js.
         * @param {HTMLCanvasElement} canvasElement - El elemento canvas donde renderizar el robot.
         */
        function initializeRobotCanvas(canvasElement) {
            // Encontrar el contenedor del canvas
            const canvasContainerElement = canvasElement.closest('.robot-avatar-container');
            if (!canvasContainerElement) {
                console.error("No se encontró el contenedor '.robot-avatar-container' para el canvas:", canvasElement);
                return;
            }

            // Solo crea una nueva instancia si no existe ya para este canvas
            if (!robotInstances.has(canvasElement)) {
                // Llama a la función global exportada por cargarCabeza2.js
                // y guarda la referencia para poder limpiar más tarde.
                const robotControls = window.initRobotHead(canvasElement, canvasContainerElement);
                robotInstances.set(canvasElement, robotControls);
            }
        }

        // --- Funciones de Utilidad de Mensajes ---

        /**
         * Función auxiliar para obtener la hora actual formateada.
         * @returns {string} La hora actual en formato HH:MM (ej. "06:33 PM").
         */
        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        /**
         * Genera el HTML para una fila de mensaje del bot (recibido) incluyendo el canvas.
         * @param {string} messageText - El texto del mensaje.
         * @param {string} time - La hora del mensaje.
         * @returns {string} El HTML completo de la fila del mensaje del bot.
         */
        function createBotMessageHtml(messageText, time) {
            return `
                <div class="message-row received">
                    <div class="robot-avatar-container">
                        <canvas class="robotCanvas"></canvas>
                    </div>
                    <div class="message-bubble received">
                        ${messageText}
                    </div>
                    <span class="message-time">${time}</span>
                </div>
            `;
        }

        /**
         * Genera el HTML para una fila de mensaje del usuario (enviado).
         * @param {string} messageText - El texto del mensaje.
         * @param {string} time - La hora del mensaje.
         * @returns {string} El HTML completo de la fila del mensaje del usuario.
         */
        function createUserMessageHtml(messageText, time) {
            return `
                <div class="message-row sent">
                    <span class="message-time">${time}</span>
                    <div class="message-bubble sent">
                        ${messageText}
                    </div>
                   <div class="avatar-container">
                        <img src="./usuario.png" style="width:100%; height:100%" />
                   </div>
                </div>
            `;
        }

        /**
         * Función asíncrona para agregar un comentario de "pensamiento"
         * y luego un mensaje real dentro del área de chat.
         * Simula una respuesta del robot con un lapso de tiempo.
         * @param {string} commentText - El texto del comentario/mensaje a mostrar.
         * @param {number} thinkingTimeMs - Tiempo en milisegundos para simular el "pensamiento".
         */
        async function addBotCommentToChat(commentText, thinkingTimeMs = 1500) {
            const chatMessages = document.querySelector('.chat-messages');

            // 1. Crear el mensaje de "Pensando..." usando el template
            const thinkingRowHtml = createBotMessageHtml(
                `Pensando<span class="thinking-dots">.</span>`,
                getCurrentTime()
            );
            
            // Convertir el string HTML en un elemento DOM para poder manipularlo y luego quitarlo
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = thinkingRowHtml.trim();
            const thinkingMessageRow = tempDiv.firstChild;
            thinkingMessageRow.classList.add('thinking-message'); 

            chatMessages.appendChild(thinkingMessageRow);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // **Inicializar el canvas del robot para el mensaje de pensamiento**
            const thinkingCanvas = thinkingMessageRow.querySelector('.robotCanvas');
            if (thinkingCanvas) {
                initializeRobotCanvas(thinkingCanvas);
            }
            
            // 2. Simular el lapso de tiempo de "pensamiento"
            await new Promise(resolve => setTimeout(resolve, thinkingTimeMs));

            // 3. Eliminar el mensaje de "Pensando..." (y su canvas)
            // Llama a dispose en la instancia del robot antes de eliminar el elemento DOM
            if (thinkingCanvas && robotInstances.has(thinkingCanvas)) {
                robotInstances.get(thinkingCanvas).dispose(); // Llama al método dispose() de la instancia
                robotInstances.delete(thinkingCanvas);
            }
            chatMessages.removeChild(thinkingMessageRow);

            // 4. Crear y agregar el mensaje real del comentario usando el template
            const finalMessageHtml = createBotMessageHtml(
                commentText,
                getCurrentTime()
            );
            
            chatMessages.insertAdjacentHTML('beforeend', finalMessageHtml);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // **Inicializar el canvas del robot para el mensaje final**
            const lastMessageCanvas = chatMessages.lastElementChild.querySelector('.robotCanvas');
            if (lastMessageCanvas) {
                initializeRobotCanvas(lastMessageCanvas);
            }
        }

        /**
         * Función para enviar un mensaje del usuario al chat.
         * Crea un nuevo elemento de mensaje "sent" y lo añade al contenedor de mensajes.
         * @param {string} messageText - El texto del mensaje a enviar.
         */
        function sendMessage(messageText) {
            const chatMessages = document.querySelector('.chat-messages');

            const messageHtml = createUserMessageHtml(messageText, getCurrentTime());
            chatMessages.insertAdjacentHTML('beforeend', messageHtml);
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // --- Event Listeners y Inicialización General ---
        document.addEventListener('DOMContentLoaded', () => {
            const messageInput = document.getElementById('messageInput');
            const sendButton = document.getElementById('sendButton');

            const handleSendMessage = () => {
                const text = messageInput.value.trim();
                if (text !== '') {
                    sendMessage(text);
                    messageInput.value = '';
                    
                    setTimeout(() => {
                        addBotCommentToChat(`Has dicho: "${text}"`, 1000);
                    }, 500); 
                }
            };

            sendButton.addEventListener('click', handleSendMessage);

            messageInput.addEventListener('keypress', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    handleSendMessage();
                }
            });

            // --- Inicialización del Canvas del Robot para el primer mensaje (Hardcodeado en HTML) ---
            const initialRobotCanvas = document.querySelector('.message-row.received .robotCanvas'); 
            if (initialRobotCanvas) {
                initializeRobotCanvas(initialRobotCanvas);
            }

            // Ejemplos de uso de las funciones al cargar (mensajes adicionales del bot)
            setTimeout(() => {
                addBotCommentToChat("¡Hola! Soy Rebeca junior , tu asistente virtual.");
            }, 2000);

            setTimeout(() => {
                addBotCommentToChat("¿Cómo puedo ayudarte hoy?", 1000);
            }, 4500);
        });
    </script>
    <script>
        import { CreateMLCEngine } from "@mlc-ai/web-llm";
        console.log("WebLLM loaded successfully!");
    </script>
</body>
</html>