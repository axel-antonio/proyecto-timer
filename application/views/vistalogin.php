<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ciber</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener un archivo CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos básicos para el formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            color: white;
            border-radius: 5px;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <div id="alert-overlay" style="display:none;">
        <div id="alert-message"></div>
        <button id="alert-close">Cerrar</button>
    </div>
    <input type="text" id="username" placeholder="Usuario" required>
    <input type="password" id="password" placeholder="Contraseña" required>
    <button id="login-btn">Login</button>
</div>

<script>
    $(document).ready(function() {
        $('#login-btn').click(function() {
            var username = $('#username').val();
            var password = $('#password').val();

            // Enviar solicitud AJAX para iniciar sesión
            $.post('index.php/Ciber/login', { username: username, password: password }, function(response) {
                if (response.success) {
                    // Redirigir o mostrar mensaje de éxito
                    window.location.href = 'dashboard.php'; // Cambia a la ruta deseada
                } else {
                    showAlert('Error al iniciar sesión: ' + response.message);
                }
            }, 'json').fail(function() {
                showAlert('Error de comunicación con el servidor.');
            });
        });

        function showAlert(message) {
            $('#alert-message').text(message);
            $('#alert-overlay').fadeIn();
        }

        $('#alert-close').click(function() {
            $('#alert-overlay').fadeOut();
        });
    });
</script>

</body>
</html>