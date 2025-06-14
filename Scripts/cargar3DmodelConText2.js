// 1. Configuración de la Escena Three.js
// Crea una nueva escena, que es un contenedor para todos los objetos 3D.
const scene = new THREE.Scene();

// Obtiene una referencia al elemento canvas del HTML.
const canvas = document.getElementById('robotCanvas');
// Obtiene una referencia al div contenedor del canvas.
const canvasContainer = document.getElementById('robotCanvasContainer');

// Obtiene una referencia al contenedor donde se mostrarán los globos de texto.
const textBubblesContainer = document.getElementById('textBubblesContainer');


// Obtener las dimensiones iniciales del contenedor
// clientWidth y clientHeight dan el tamaño del área visible del elemento, excluyendo bordes y barras de desplazamiento.
let containerWidth = canvasContainer.clientWidth;
let containerHeight = canvasContainer.clientHeight;

// Crea una cámara de perspectiva. Los parámetros son:
// 75: Campo de visión (Field of View - FOV) vertical en grados.
// containerWidth / containerHeight: Relación de aspecto de la cámara (ancho / alto del CONTENEDOR).
// 0.1: Plano de recorte cercano (objetos más cerca que esto no se renderizarán).
// 1000: Plano de recorte lejano (objetos más lejos que esto no se renderizarán).
const camera = new THREE.PerspectiveCamera(75, containerWidth / containerHeight, 0.1, 1000);

// Crea un renderizador WebGL. Es el motor que dibuja la escena en el canvas.
// 'canvas': El elemento HTMLCanvasElement donde se dibujará la escena.
// 'alpha: true': Hace que el fondo del renderizador sea transparente (si no quieres un color de fondo sólido).
const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true });

// Establece el tamaño del renderizador para que coincida con el tamaño del CONTENEDOR del canvas.
renderer.setSize(containerWidth, containerHeight);

// Opcional: Descomenta la siguiente línea para establecer un color de fondo sólido (ej. azul claro)
// renderer.setClearColor(0xabcdef, 1);

// Añadir luces a la escena (¡importante para ver el modelo!)
// Sin luces, los modelos aparecerán completamente negros en un renderizador 3D.

// Luz Ambiental: Ilumina todos los objetos de la escena de manera uniforme, sin sombras fuertes.
// 0xffffff: Color blanco de la luz.
// 0.8: Intensidad de la luz (0 a 1).
const ambientLight = new THREE.AmbientLight(0xffffff, 0.8);
scene.add(ambientLight);

// Luz Direccional: Simula la luz del sol o una fuente de luz distante, con sombras paralelas.
// 0xffffff: Color blanco de la luz.
// 0.6: Intensidad de la luz.
const directionalLight = new THREE.DirectionalLight(0xffffff, 0.6);
// Establece la posición de la luz en el espacio 3D (X, Y, Z). .normalize() asegura que la dirección sea consistente.
directionalLight.position.set(1, 1, 1).normalize();
scene.add(directionalLight);

// 2. Cargar el modelo 3D del robot
let robot; // Variable global para almacenar el objeto principal del modelo (gltf.scene).
// robotPartToMove será la parte específica del robot (el 'Body') que rotará.
let robotPartToMove;

// Crea una instancia del cargador GLTF. Este cargador es necesario para modelos .gltf y .glb.
const loader = new THREE.GLTFLoader();

// Inicia la carga del modelo 3D.
// El primer argumento es la ruta al archivo del modelo.
// (Ten en cuenta que '../3D models/' significa "subir un nivel y luego ir a la carpeta '3D models'")
loader.load(
    './3D models/robot2.glb', // Asegúrate de que esta ruta es correcta y la extensión coincide.
    function (glb) {
        // La función de callback se ejecuta una vez que el modelo ha sido cargado.
        robot = glb.scene; // 'gltf.scene' contiene la jerarquía de objetos 3D del modelo.
        scene.add(robot); // Añade el modelo completo a la escena.

        // *** LÓGICA PARA ENCONTRAR LA PARTE ESPECÍFICA DEL ROBOT A MOVER ***
        // Según tu jerarquía: robot -> Character -> Body
        // Primero buscamos el grupo 'Character' dentro del robot principal.
        const characterGroup = robot.getObjectByName('Character'); 

        if (characterGroup) {
            // Si 'Character' se encontró, buscamos el objeto 'body' dentro de 'Character'.
            // ¡Importante! Asegúrate que el nombre 'body' coincide exactamente (mayúsculas/minúsculas)
            robotPartToMove = characterGroup.getObjectByName('body'); 
            
            if (!robotPartToMove) {
                // Si 'body' no se encuentra dentro de 'Character', muestra una advertencia.
                console.warn("¡Advertencia! No se encontró el objeto 'body' dentro de 'Character'. La rotación se aplicará al robot completo como fallback.");
                // Como fallback, la rotación se aplicará al objeto raíz del robot.
                robotPartToMove = robot; 
            } else {
                // Si la parte deseada se encuentra, lo confirmamos en la consola.
                console.log("Parte del robot para mover encontrada:", robotPartToMove);
            }
        } else {
            // Si 'Character' no se encuentra, muestra una advertencia.
            console.warn("¡Advertencia! No se encontró el objeto 'Character'. La rotación se aplicará al robot completo como fallback.");
            // Como fallback, la rotación se aplicará al objeto raíz del robot.
            robotPartToMove = robot; 
        }
        // *** FIN DE LA LÓGICA DE BÚSQUEDA DE LA PARTE ESPECÍFICA ***


        // Opcional: Ajustar escala y posición inicial del robot completo.
        // Estos valores son para todo el modelo, no solo para la parte que rotará.
        // Debes ajustar estos valores para que el robot sea visible y esté bien posicionado.
        robot.scale.set(0.6, 0.6, 0.6); // Ejemplo: reduce la escala si el robot es muy grande.
        robot.position.set(0, 1, 0);   // Ejemplo: mueve el robot ligeramente hacia arriba en el eje Y.

        // Inicia el temporizador para los mensajes aleatorios una vez que el robot se ha cargado
        startRandomMessageInterval();
    },
    // Opcional: Función de progreso de carga (muestra el porcentaje de carga en la consola).
    function (xhr) {
        console.log((xhr.loaded / xhr.total * 100) + '% loaded');
    },
    // Función de error: se ejecuta si hay un problema al cargar el modelo.
    function (error) {
        console.error('An error happened while loading the model:', error);
    }
);

// 3. Variables para la posición del cursor y la rotación del robot
const mouse = new THREE.Vector2(); // Almacena las coordenadas normalizadas del ratón (-1 a 1).
let targetRotationX = 0; // Rotación objetivo en el eje X (para movimiento vertical de la cabeza).
let targetRotationY = 0; // Rotación objetivo en el eje Y (para movimiento horizontal de la cabeza).
const rotationSpeed = 0.05; // Velocidad con la que la cabeza sigue al cursor (interpolación suave).

// 4. Detectar movimiento del cursor
// Escucha el evento 'mousemove' en toda la ventana del navegador.
window.addEventListener('mousemove', (event) => {
    // Para normalizar las coordenadas del ratón a un rango de -1 a 1, relativo al canvas.
    // getBoundingClientRect() devuelve el tamaño del elemento y su posición relativa al viewport.
    const rect = canvas.getBoundingClientRect();

    // Calcula la posición X e Y del ratón dentro del canvas (relativa a la esquina superior izquierda del canvas).
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    // Normaliza las coordenadas a un rango de -1 a 1.
    // mouse.x: -1 (izquierda) a +1 (derecha).
    mouse.x = (x / rect.width) * 2 - 1;
    // mouse.y: -1 (abajo) a +1 (arriba) en el sistema de coordenadas de Three.js.
    mouse.y = -((y / rect.height) * 2 - 1); 

    // Convierte las coordenadas normalizadas del ratón en ángulos de rotación.
    // Los multiplicadores (0.25 y 0.25) controlan la sensibilidad y el rango máximo de rotación.
    targetRotationY = mouse.x * Math.PI * 0.25; // Rotación horizontal (alrededor del eje Y).
    targetRotationX = mouse.y * Math.PI * 0.25; // Rotación vertical (alrededor del eje X).
});

// 5. Bucle de Animación (render loop)
// Esta función se llama repetidamente para actualizar la escena y renderizarla.
function animate() {
    // requestAnimationFrame solicita al navegador que llame a 'animate' en el próximo ciclo de renderizado.
    // Esto asegura una animación suave y eficiente.
    requestAnimationFrame(animate);

    // Solo intenta rotar la parte del robot si ya ha sido cargada y encontrada.
    if (robotPartToMove) {
        // Interpola suavemente la rotación actual de la parte del robot hacia la rotación objetivo.
        // Esto crea un efecto de seguimiento suave en lugar de un movimiento brusco.
        robotPartToMove.rotation.y += (targetRotationY - robotPartToMove.rotation.y) * rotationSpeed;
        robotPartToMove.rotation.x += (targetRotationX - robotPartToMove.rotation.x) * rotationSpeed;

        // Opcional: Limita la rotación de la parte para evitar que se voltee o rote de forma no natural.
        // Esto restringe la rotación vertical a un rango razonable (ej. ±18 grados).
        robotPartToMove.rotation.x = Math.max(-Math.PI * 0.1, Math.min(Math.PI * 0.1, robotPartToMove.rotation.x));
    }

    // Renderiza la escena desde la perspectiva de la cámara.
    renderer.render(scene, camera);
}

animate(); // Inicia el bucle de animación al cargar el script.

// 6. Manejar el redimensionamiento de la ventana del navegador
// Este evento asegura que la escena se adapte si el usuario cambia el tamaño de la ventana.
window.addEventListener('resize', () => {
    // Obtener las nuevas dimensiones del CONTENEDOR del canvas.
    containerWidth = canvasContainer.clientWidth;
    containerHeight = canvasContainer.clientHeight;

    // Actualiza la relación de aspecto de la cámara para evitar distorsiones.
    camera.aspect = containerWidth / containerHeight;
    camera.updateProjectionMatrix(); // Recalcula la matriz de proyección de la cámara después de cambiar el aspecto.
    
    // Ajusta el tamaño del renderizador al nuevo tamaño del CONTENEDOR.
    renderer.setSize(containerWidth, containerHeight);
});

// Posición inicial de la cámara en la escena 3D.
// Ajusta este valor si el robot es muy grande (aumenta 'z') o muy pequeño (disminuye 'z') inicialmente.
camera.position.z = 5;


// === LÓGICA DE GLOBOS DE TEXTO ===

// Lista de mensajes de ejemplo para el bot
const botMessages = [
    "¡Hola! ¿Necesitas ayuda?",
    "Estoy aquí para escucharte.",
    "¿Qué tal el día?",
    "¡Qué interesante!",
    "Pensando... 🤔",
    "¿Hay algo más en lo que pueda asistirte?",
    "¡Me alegra verte!",
    "El clima es agradable hoy, ¿no crees?",
    "Recuerda que estoy aprendiendo.",
    "¿Listo para un nuevo desafío?"
];

/**
 * Muestra un globo de texto con un mensaje dado y lo elimina después de un tiempo.
 * @param {string} message - El texto a mostrar en el globo.
 * @param {number} displayDuration - Duración en ms que el globo estará visible antes de empezar a desaparecer. (Default: 3000ms)
 * @param {number} animationDuration - Duración en ms de las animaciones de fade. (Default: 500ms)
 */
function showTextBubble(message, displayDuration = 3000, animationDuration = 500) {
    const bubble = document.createElement('div');
    bubble.classList.add('text-bubble');
    bubble.textContent = message;

    // Añadir al contenedor de globos de texto para que sus dimensiones puedan ser calculadas
    textBubblesContainer.appendChild(bubble);

    // Obtener las dimensiones del contenedor y del globo recién añadido
    const containerRect = textBubblesContainer.getBoundingClientRect();
    // Use offsetWidth and offsetHeight after appending to get actual rendered size
    const bubbleWidth = bubble.offsetWidth;
    const bubbleHeight = bubble.offsetHeight;

    // Calcular posiciones aleatorias dentro de los límites del contenedor
    // Asegurarse de que el globo no se salga de los límites
    // Restamos el tamaño del globo para que el borde derecho/inferior no se salga
    const randomLeft = Math.random() * (containerRect.width - bubbleWidth);
    const randomTop = Math.random() * (containerRect.height - bubbleHeight);

    bubble.style.left = `${randomLeft}px`;
    bubble.style.top = `${randomTop}px`;

    // Activar animación de fade-in
    bubble.classList.add('fade-in');

    // Quitar fade-in y empezar fade-out después de 'displayDuration'
    setTimeout(() => {
        bubble.classList.remove('fade-in');
        bubble.classList.add('fade-out');

        // Eliminar el elemento del DOM después de que la animación de fade-out termine
        setTimeout(() => {
            if (bubble.parentNode) { // Verifica si el globo todavía tiene un padre antes de intentar eliminarlo
                bubble.parentNode.removeChild(bubble);
            }
        }, animationDuration);

    }, displayDuration);
}

// Función para mostrar un globo de texto aleatorio de la lista
function showRandomBotMessage() {
    const randomIndex = Math.floor(Math.random() * botMessages.length);
    const message = botMessages[randomIndex];
    showTextBubble(message);
}

// *** Lógica para que los globos aparezcan "de vez en cuando" ***
let messageIntervalTimer; // Variable para almacenar el ID del temporizador

function startRandomMessageInterval() {
    // Limpiar cualquier temporizador anterior para evitar duplicados si se llama varias veces
    if (messageIntervalTimer) {
        clearTimeout(messageIntervalTimer);
    }

    // Define un rango de tiempo aleatorio entre mensajes (ej. 5 a 15 segundos)
    const minDelay = 2000; // Mínimo 5 segundos
    const maxDelay = 5000; // Máximo 15 segundos

    // Función que programa el próximo mensaje
    const setNextMessageTimer = () => {
        const randomDelay = Math.random() * (maxDelay - minDelay) + minDelay;
        messageIntervalTimer = setTimeout(() => {
            showRandomBotMessage(); // Muestra un mensaje
            setNextMessageTimer(); // Vuelve a llamar para programar el siguiente mensaje
        }, randomDelay);
    };

    setNextMessageTimer(); // Inicia el primer temporizador para el primer mensaje
}

// NOTA: La llamada a 'startRandomMessageInterval()' se ha movido dentro del 'loader.load()'
// Esto asegura que los mensajes no empiecen a aparecer hasta que el robot esté cargado y visible.
// Puedes encontrarla al final de la función de carga del modelo.
