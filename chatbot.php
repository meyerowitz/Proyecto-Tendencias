<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Simple</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }

        .chatbot-container {
            width: 350px;
            height: 500px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chatbot-header {
            background-color: #4CAF50; /* Un verde vibrante */
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chatbot-header h2 {
            margin: 0;
            font-size: 1.2em;
        }

        .chatbot-header .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .chatbot-header .close-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .chatbot-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #e5ddd5; /* Color de fondo tipo WhatsApp */
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message {
            max-width: 70%;
            padding: 10px 12px;
            border-radius: 8px;
            word-wrap: break-word;
        }

        .bot-message {
            background-color: #dcf8c6; /* Verde claro para mensajes del bot */
            align-self: flex-start; /* Alinea a la izquierda */
        }

        .user-message {
            background-color: #ffffff; /* Blanco para mensajes del usuario */
            align-self: flex-end; /* Alinea a la derecha */
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .chatbot-input {
            display: flex;
            padding: 15px;
            border-top: 1px solid #eee;
            background-color: #f7f7f7;
        }

        .chatbot-input input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            margin-right: 10px;
            font-size: 1em;
            outline: none;
        }

        .chatbot-input button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .chatbot-input button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="chatbot-container">
        <div class="chatbot-header">
            <h2>Mi Chatbot</h2>
            <button id="closeChatBtn" class="close-btn">&times;</button>
        </div>
        <div class="chatbot-messages" id="chatbotMessages">
            <div class="message bot-message">
                Hola, ¿en qué puedo ayudarte hoy?
            </div>
        </div>
        <div class="chatbot-input">
            <input type="text" id="chatInput" placeholder="Escribe tu mensaje...">
            <button id="sendMessageBtn">Enviar</button>
        </div>
    </div>

    <script src="js/chatbot.js"></script>

</body>
</html>