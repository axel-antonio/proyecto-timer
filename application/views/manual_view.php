<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual de Usuario</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"> <!-- Enlazar a tu CSS principal -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        h1, h2, h3 {
            color: #3498db;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
        }

        img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .btn-flotante {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #3498db;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease, transform 0.3s ease;
            z-index: 1000;
        }

        .btn-flotante i {
            font-size: 24px;
        }

        .btn-flotante:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .manual-section {
            margin-bottom: 40px;
        }

        .manual-section h2 {
            margin-bottom: 10px;
        }

        .manual-section ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .manual-section ul li {
            margin-bottom: 10px;
        }

        .manual-section img {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manual de Usuario</h1>
        <p>El software de Control de Tiempo es una herramienta diseñada para la gestión y control del tiempo en servicios como cibercafés, boliches, billares o cualquier otro negocio que requiera el registro de tiempo por máquina o recurso.</p>

        <div class="manual-section">
            <h2>1. Menú de Control</h2>
            <p>En el lado izquierdo de la pantalla encontrarás el menú principal con las siguientes opciones:</p>
            <ul>
                <li>Agregar Máquina: Botón de color azul que te permite añadir una nueva máquina al sistema.</li>
                <li>Eliminar Máquina: Botón que te permite eliminar una máquina seleccionada de la lista.</li>
            </ul>
           
            <img src="<?= base_url('assets/images/imagen1.png') ?>" alt="Menú de control">
            <img src="<?= base_url('assets/images/imagen2.png') ?>" alt="Formulario para agregar máquina">

        </div>

        <div class="manual-section">
            <h2>2. Agregar una nueva máquina</h2>
            <p>Haz clic en el botón azul "Agregar Máquina" en el menú lateral izquierdo. Se abrirá una nueva ventana con el formulario de agregar nueva máquina. Ingresa el nombre y haz clic en "Agregar Máquina".</p>
            <img src="<?= base_url('assets/images/imagen3.png') ?>" alt="Panel de control de la máquina">

            <img src="<?= base_url('assets/images/imagen4.png') ?>" alt="Iniciar y finalizar máquina">

            <img src="<?= base_url('assets/images/imagen5.png') ?>" alt="Enviar mensaje">

            <img src="<?= base_url('assets/images/imagen6.png') ?>" alt="Mensaje enviado correctamente">

        </div>

        <div class="manual-section">
            <h2>3. Panel de Control de Máquina</h2>
            <p>En el centro de la pantalla se encuentra el panel de control de la máquina seleccionada. Aquí podrás ver la siguiente información:</p>
            <ul>
                <li>Nombre de la Máquina.</li>
                <li>Icono de la máquina.</li>
                <li>Tiempo de uso y cronómetro.</li>
                <li>Estado: Indica si está "En uso" o "Sin usar".</li>
                <li>Opciones para parar el uso automáticamente o manualmente.</li>
            </ul>


            <img src="<?= base_url('assets/images/imagen7.png') ?>" alt="Seleccionar máquina">

                   </div>

        <div class="manual-section">
            <h2>4. Iniciar y Finalizar una Máquina</h2>
            <p>Para iniciar el cronómetro, selecciona la máquina desde el menú desplegable y haz clic en "Iniciar". Para finalizar, haz clic en "Finalizar".</p>
                        <img src="<?= base_url('assets/images/imagen8.png') ?>" alt="Eliminar máquina">
                        <img src="<?= base_url('assets/images/imagen9.png') ?>" alt="Confirmar eliminación">
                        <img src="<?= base_url('assets/images/imagen10.png') ?>" alt="Máquina eliminada">

        
        </div>

       

        

        <div class="manual-section">
            <h2>5. Pasos adicionales para el uso del sistema</h2>
            <ol>
                <li>Selecciona la máquina desde el desplegable.</li>
                
                <li>Haz clic en el botón verde "Iniciar" para comenzar a usar la máquina.</li>
                                              <li>Para el uso de la máquina, puedes programar que la máquina se detenga automáticamente ingresando un valor en el campo "Parar a (min)".</li>

                                              <img src="<?= base_url('assets/images/imagen11.png') ?>" alt="Seleccionar máquina">
                           <li>También puedes detener la máquina manualmente haciendo clic en el botón rojo "Finalizar".</li>
                           <img src="<?= base_url('assets/images/imagen12.png') ?>" alt="Iniciar máquina">

                          </ol>
        </div>

        <div class="manual-section">
            <h2>6. Finalización de sesión y alertas</h2>
            <p>Cuando el temporizador configurado para finalizar se cumple, se mostrará una alerta sonora y visual indicando el fin de la sesión. Puedes cerrarla presionando el botón "Cerrar".</p>
            <img src="<?= base_url('assets/images/imagen13.png') ?>" alt="Iniciar máquina activa">
       
        </div>

        <div class="manual-section">
            <h2>7. Enviar mensajes adicionales</h2>
            <p>Para enviar un mensaje a la máquina seleccionada, escribe el mensaje en el campo "Mensaje" y haz clic en el icono de envío. Aparecerá una alerta confirmando el envío del mensaje.</p>
            <img src="<?= base_url('assets/images/imagen14.png') ?>" alt="Parar máquina automáticamente">
     
            <img src="<?= base_url('assets/images/imagen15.png') ?>" alt="Finalizar máquina manualmente">
          
            <img src="<?= base_url('assets/images/imagen16.png') ?>" alt="Alerta de finalización">
          
        </div>

        <div class="manual-section">
            <h2>8. Eliminar máquinas del sistema</h2>

            <p>Para eliminar una máquina, selecciona la máquina que deseas eliminar y sigue los pasos que se mencionan en la sección de eliminación. Recuerda que una vez eliminada, no se podrá recuperar.</p>
            <img src="<?= base_url('assets/images/imagen17.png') ?>" alt="Enviar mensaje adicional">
 
            <img src="<?= base_url('assets/images/imagen18.png') ?>" alt="Confirmación de mensaje enviado">

            <img src="<?= base_url('assets/images/imagen19.png') ?>" alt="Confirmación de eliminación">
            <img src="<?= base_url('assets/images/imagen20.png') ?>" alt="Máquina eliminada">
        </div>
    </div>

    <!-- Botón flotante para regresar a la página principal -->
    <a href="<?= base_url('index.php/Ciber') ?>" class="btn-flotante" title="Regresar a la Página Principal">
        <i class="fas fa-home"></i>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
