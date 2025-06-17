<DOCTYPE html>
    <html>
        
        <head>
            <meta charset="utf-8">
            <title>Acceder</title>
            
            
        </head>
        <style>
 /* CSS */
.button-85 {
  padding: 0.5em 2em;
  border: 1px solid white;
  outline: none;
  color: rgb(12, 11, 42);
  background: #111;
  cursor: pointer;
  position: absolute;
  z-index: 11;
  border-radius: 10px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  text-decoration:none;
  top:40%;
  right:50%;
font-size:45px;
}

.button-85:before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #002bff,
    #7a00ff,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  -webkit-filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing-button-85 20s linear infinite;
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

@keyframes glowing-button-85 {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}

.button-85:after {
  z-index: -1;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-color:rgb(255, 255, 255);
  left: 0;
  top: 0;
  border-radius: 10px;
}

 * {
    margin: 0px;
    padding: 0px;
  }
  
  #sidebar {
    position: fixed;
    width: 200px;
    height: 100%;
    background: #151719;
    left: -200px;
    transition: all 500ms linear;
    z-index: 10;
  }
  
  #sidebar.active {
    left: 0px;
  }
  
  #sidebar ul li {
    color: rgba(230, 230, 230, .9);
    list-style: none;
    padding: 15px 10px;
    border-bottom: 1px solid rgba(100, 100, 100, .3);
    text-align: center;
  }
  
  .logo {
    border-radius: 50%;
    display: block;
    margin: 0 auto; 
  }
  
#toggle-btn {
    position: absolute;
    left: 215px;
    top: 12px;
    background:darkblue;
    cursor: pointer;
    transition: all 0.5s linear;
    border-radius:5px;
  }
  
#toggle-btn span {
    display: block;
    width: 40px;
    text-align: center;
    font-size: 30px;
    color: #fff;
  }
#toggle-btn.active {
    left:15px;
    background:#777;
  }

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
                left:-1.5%;
                top:-5%;
                z-index: 1;
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
                font-size:55px ;
            }
            p {
                color: #666666;
            }

/* ====================================================== */
/* Estilos para el TÍTULO con efecto de AUREOLA en las letras */
/* ====================================================== */
/* En tu archivo CSS o dentro de una etiqueta <style> */

/* ====================================================== */
/* Estilos para el TÍTULO con efecto glowing */
/* ====================================================== */
.titulo-glowing {
  /* Propiedades base copiadas de .button-85 */
  padding: 0.5em 3.5em;
  border: 1px solid white; /* Mantener borde blanco si lo deseas */
  outline: none;
  background: #111; /* Fondo oscuro para que el brillo resalte */
  cursor: default; /* Un título no es un botón, no necesita cursor de puntero */
  position: relative; /* Muy importante para que ::before y ::after se posicionen correctamente */
  z-index: 1; /* Asegura que el título esté sobre el efecto */
  border-radius: 10px; /* Bordes redondeados */
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  text-decoration: none;

  /* Propiedades específicas del título, ajustadas para el efecto */
  font-family: 'Anton', sans-serif;
  font-size: 45px; /* Tamaño de fuente del título original */
  letter-spacing: 0px;
  word-spacing: 0px;
  color: rgb(255, 255, 255); /* CAMBIO: Color del texto a blanco para que contraste con el fondo oscuro y el brillo */
  font-weight: bold;
  font-style: normal;
  font-variant: normal;
  text-transform: none;

  /* Ajustes de posicionamiento si es un título principal */
  display: inline-block; /* Permite que el padding y el ancho se apliquen correctamente */
  margin: 20px auto; /* Para centrarlo si lo deseas */
  
  /* Ajuste para el z-index si está dentro de .encabezado */
  /* Si el .encabezado ya tiene position: absolute; y z-index: 2, esto puede que no sea necesario */
  /* Pero es buena práctica ponerlo para el pseudoelemento */
}

.titulo-glowing::before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #002bff,
    #7a00ff,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1; /* Detrás del texto del título */
  filter: blur(5px);
  -webkit-filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing-button-85 20s linear infinite; /* Misma animación */
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

.titulo-glowing::after {
  z-index: -1; /* Detrás del texto del título */
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: darkblue; /* CAMBIO: El color de fondo del título para que el brillo se vea a través de él */
  left: 0;
  top: 0;
  border-radius: 10px;
}

/* La animación @keyframes glowing-button-85 ya la tienes definida y es la misma que usaremos */
/* NO necesitas duplicar @keyframes glowing-button-85 */

/* Código existente de .button-85 */
.button-85 {
  padding: 0.5em 2em;
  border: 1px solid white;
  outline: none;
  color: rgb(12, 11, 42); /* Color de texto original */
  background: #111;
  cursor: pointer;
  position: absolute;
  z-index: 11;
  border-radius: 10px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  text-decoration: none;
  top: 40%;
  right: 50%;
  font-size: 45px;
}

.button-85:before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #002bff,
    #7a00ff,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  -webkit-filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing-button-85 20s linear infinite;
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

@keyframes glowing-button-85 {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}

.button-85:after {
  z-index: -1;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgb(255, 255, 255); /* Color de fondo del botón */
  left: 0;
  top: 0;
  border-radius: 10px;
}

/* Resto de tu CSS... */

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
            /* Permite que el canvas se posicione sobre otros elementos */
            }
            #robotCanvasContainer {
                height: 120%;
                width: 100%;
                position: absolute;
                margin-left:20%;
                margin-top:-5%;
            }
            #robotCanvasContainerbefore {
                height: 120%;
                width: 130%;
                position: absolute;
                margin-left:15%;
                margin-top:-5%;
                background-color: rgba(255, 255, 255, 0.44); /* Fondo semitransparente para ver el efecto */
                backdrop-filter: blur(10px); /* Aplica el desenfoque al contenido detrás */
                box-shadow: rgba(255, 255, 255, 0.15) 0px 48px 100px 0px;
                z-index: -1;
            }
            .chatbot{
                position: absolute; 
                text-decoration: none; 
                top: 60%; 
                background-color: white; 
                padding-top: 40px;
                padding-bottom: 40px;
                padding-left: 70px;
                padding-right: 70px; 
                border-radius: 5%; 
                box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
                color: black; 
                font-size: 20px; 
                font-weight: bold; 
                transition: background-color 0.3s ease;
                left:30%;
                z-index: 11;
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
            background-color: #f0f0f0;  /* Borde suave */box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;
            padding: 20px 25px; /* Relleno interno */
            border-radius: 20px; /* Esquinas redondeadas para un aspecto amigable */
            box-shadow: 0 2px 5px rgba(0, 37, 75, 0.1); /* Sombra ligera */
            opacity: 0; /* Empieza invisible para la animación de fade-in */
            animation-fill-mode: forwards; /* Mantiene el estado final de la animación */
            position: relative; /* Necesario para el "rabillo" del globo */
            font-size: 1.2em; /* Tamaño de fuente */
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

        .cube {
  position: absolute;
  top: 80vh;
  left: 45vw;
  width: 10px;
  height: 10px;
  border: solid 1px #003298;
  -webkit-transform-origin: top left;
          transform-origin: top left;
  -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
          transform: scale(0) rotate(0deg) translate(-50%, -50%);
  -webkit-animation: cube 12s ease-in forwards infinite;
          animation: cube 12s ease-in forwards infinite;
}
.cube:nth-child(2n) {
  border-color: #0051f4;
}
.cube:nth-child(2) {
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
  left: 25vw;
  top: 40vh;
}
.cube:nth-child(3) {
  -webkit-animation-delay: 4s;
          animation-delay: 4s;
  left: 75vw;
  top: 50vh;
}
.cube:nth-child(4) {
  -webkit-animation-delay: 6s;
          animation-delay: 6s;
  left: 90vw;
  top: 10vh;
}
.cube:nth-child(5) {
  -webkit-animation-delay: 8s;
          animation-delay: 8s;
  left: 10vw;
  top: 85vh;
}
.cube:nth-child(6) {
  -webkit-animation-delay: 10s;
          animation-delay: 10s;
  left: 50vw;
  top: 10vh;
}
.hero {
  height: 100vh;
  overflow: hidden;
  background-image: linear-gradient(rgba(0, 132, 255, 0.16), rgba(32, 24, 100, 0));
}
@-webkit-keyframes cube {
  from {
    -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
    opacity: 1;
  }
  to {
    -webkit-transform: scale(20) rotate(960deg) translate(-50%, -50%);
            transform: scale(20) rotate(960deg) translate(-50%, -50%);
    opacity: 0;
  }
}

@keyframes cube {
  from {
    -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
    opacity: 1;
  }
  to {
    -webkit-transform: scale(20) rotate(960deg) translate(-50%, -50%);
            transform: scale(20) rotate(960deg) translate(-50%, -50%);
    opacity: 0;
  }
}
        </style>
        <body>
        <div id="niebla" class="niebla"></div>
        <div id="fadein" class="fadein">
          <div id="sidebar">
              <div id="toggle-btn" >
                <span>&#9776</span>
              </div>
            <ul>
                <li>
                  <img src="img/logo.jpg" alt="Logo Fazt" class="logo">
                </li>
                <li><a href="./frame/index.php">Inicio</a> </li>
                <li><a href="#">Perfil</a> </li>
                <li><a href="#">Pedidos</a></li>
                <li><a href="#">Ayuda</a> </li>
                <li><a href="#">Salir</a></li>
            </ul>
          </div>
            <div id="Encabezado" class="encabezado">    
                <h1 class="titulo-glowing">Servicio Comunitario UNEG</h1>
                <p style="font-size:35px; color: darkblue">Tejiendo el futuro con IA</p>
            </div>
            
            <!-- HTML !-->
            <a href="chat.php" class="button-85">Chat bot</a>

            <div id="textBubblesContainer">
                <!-- Los globos de texto aparecerán aquí -->
            </div>
            <div id="robotCanvasContainer">
                <canvas id="robotCanvas"></canvas>
            </div>

    
                <script src="./Scripts/three.min.js"></script>
                <script src="./Scripts/GLTFLoader.js"></script>
                <script src="./Scripts/tween.umd.min.js"></script>
                
                <script src="./Scripts/cargar3D.js"></script>
             
              
               
                
               
                <script>
                  // Ejecutar hasta que todo esté cargado
                  window.onload = function() {
                  // Variable para controlar el botón
                    let btn = document.getElementById('toggle-btn');

                  // Variable para controlar el menú
                    let side = document.getElementById('sidebar');

                  // Agregar evento "onclick" al botón

                  

                    btn.addEventListener('click', function() {
                  // Agregar o quitar clase "active" a botón y menú
                    btn.classList.toggle('active');
                    side.classList.toggle('active');
                    
                  });
                  }

                    document.getElementById('fadein').style.opacity = 0;
                    setTimeout(() => {
                        document.getElementById('fadein').style.opacity = 1;
                        document.getElementById('fadein').style.transition = 'opacity 2s';
                    }, 1000);
                </script>
                 <div  class="hero">
                
                <div class="cube"></div>
                <div class="cube"></div>
                <div class="cube"></div>
                <div class="cube"></div>
                <div class="cube"></div>
                <div class="cube"></div>
            </div>
        </div>
           
        </body>
    </html>

