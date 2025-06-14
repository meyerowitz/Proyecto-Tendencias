<DOCTYPE html>
    <html>
        
        <head>
            <meta charset="utf-8">
            <title>Acceder</title>
            
            
        </head>
        <style>
            body {
                background-color: #f0f0f0;
                font-family: Arial, sans-serif;
                text-align: center;
                overflow: hidden;
                margin: 0;
            }
            .encabezado {
                color: white;
                padding: 20px;
                position: absolute;
                z-index: 2;
            }
            .div {
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                max-width: 400px;
                margin: auto;
            }
            h1 {
                color: #333333;
                font-size:50px ;
            }
            p {
                color: #666666;
            }
            .divcanvas{
                justify-content: center;
                align-items: center;
                overflow:hidden;
                display: block;
                height:100vh;
            }
            canvas {
            display: block; /* Elimina espacio extra debajo del canvas */
            width: 100%;    /* El canvas ocupa todo el ancho de su contenedor */
            height: 100%;   /* El canvas ocupa todo el alto de su contenedor */
            }
            #robotCanvasContainer {
                height: 110%;
                width: 60%;
                position : absolute;
                left:40%;
                top:-10%;
            }
            .chatbot{
                position: absolute; text-decoration: none; top: 40%; background-color: white; padding-top: 20px;padding-bottom: 20px;padding-left: 40px;padding-right: 40px; border-radius: 5%; 
                box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
                color: black; font-size: 20px; font-weight: bold; left: 10%; transition: background-color 0.3s ease;
                left:5%
            }

        /* Contenedor de los Globos de Texto */
        #textBubblesContainer {
            position: absolute; /* Posiciona el contenedor de forma absoluta en la página */
            top: 50%; /* Alinea el centro vertical con el centro de la pantalla */
            /* left: calc(50% + 200px); */ /* Posiciona 200px a la derecha del centro de la pantalla. Ajusta 200px según el tamaño del robot */
            right: 5vw; /* Alternativa: 5% del ancho del viewport desde la derecha */
            transform: translateY(-50%); /* Ajusta verticalmente para centrar bien */
            z-index: 10; /* Asegura que esté por encima del canvas */
            display: flex;
            flex-direction: column; /* Apila los globos de texto verticalmente */
            gap: 10px; /* Espacio entre globos de texto */
            pointer-events: none; /* Permite que los clics pasen a los elementos de abajo */
            max-width: 250px; /* Limita el ancho máximo de un globo de texto */
        }

        /* Estilo de los Globos de Texto Individuales */
        .text-bubble {
            background-color: #f0f0f0; /* Fondo claro del globo */
            border: 1px solid #ccc; /* Borde suave */
            padding: 10px 15px; /* Relleno interno */
            border-radius: 20px; /* Esquinas redondeadas para un aspecto amigable */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Sombra ligera */
            opacity: 0; /* Empieza invisible para la animación de fade-in */
            animation-fill-mode: forwards; /* Mantiene el estado final de la animación */
            position: relative; /* Necesario para el "rabillo" del globo */
            font-size: 0.9em; /* Tamaño de fuente */
            color: #333; /* Color del texto */
            text-align: left; /* Alineación del texto */
            white-space: normal; /* Permite que el texto se ajuste a la línea */
            align-self: flex-end; /* Alinea el globo a la derecha dentro de su contenedor */
        }

        /* Estilo del "rabillo" del globo de texto (opcional, pero añade realismo) */
        .text-bubble::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -10px; /* Posiciona a la izquierda para apuntar hacia el robot */
            width: 0;
            height: 0;
            border-top: 10px solid transparent; /* Crea la forma de la flecha */
            border-right: 10px solid #f0f0f0; /* Color que coincida con el fondo del globo */
            border-bottom: 10px solid transparent;
            transform: translateY(-50%); /* Centra verticalmente el rabillo */
        }

        /* Animaciones CSS Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); } /* Empieza más abajo y transparente */
            to { opacity: 1; transform: translateY(0); } /* Termina en su posición y visible */
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); } /* Empieza visible */
            to { opacity: 0; transform: translateY(20px); } /* Termina más abajo y transparente */
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards; /* Aplica la animación de entrada */
        }

        .fade-out {
            animation: fadeOut 0.5s ease-out forwards; /* Aplica la animación de salida */
        }
        </style>
        <body>
        <div id="niebla" class="niebla"></div>
        <div id="fadein" class="fadein">
            <div id="Encabezado" class="encabezado">    
                <h1>Servicio Comunitario UNEG</h1>
                <p>Tejiendo el futuro con IA</p>
            </div>
            <div id="textBubblesContainer">
                <!-- Los globos de texto aparecerán aquí -->
            </div>
            <div id="robotCanvasContainer">
                <canvas id="robotCanvas"></canvas>
            </div>
                <script src="./Scripts/three.min.js"></script>
                <script src="./Scripts/GLTFLoader.js"></script>
                <script src="./Scripts/cargar3DmodelConText2.js"></script>
                
              
                <a href="chatbot.html" class="chatbot">Chatbot</a>
                <script>
                    document.getElementById('fadein').style.opacity = 0;
                    setTimeout(() => {
                        document.getElementById('fadein').style.opacity = 1;
                        document.getElementById('fadein').style.transition = 'opacity 2s';
                    }, 1000);
                </script>
        </div>
            
           
        </body>
    </html>


</DOCTYPE>