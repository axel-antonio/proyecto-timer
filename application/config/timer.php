<?php
session_start();

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['password'])) {
    header('Location: index.php');
    exit;
}

// Mostrar el temporizador o cronómetro
echo "Temporizador en marcha...";

// Verificar si el usuario intenta pausar o reiniciar
if (isset($_POST['pause']) || isset($_POST['restart'])) {
    // Solicitar la contraseña o PIN de seguridad para desbloquear
    echo "Ingrese la contraseña o PIN de seguridad para desbloquear: ";
    $entered_password = $_POST['password'];

    if ($entered_password == $_SESSION['password']) {
        // Desbloquear la sesión
        $_SESSION['locked'] = false;
        echo "Sesión desbloqueada";
    } else {
        echo "Contraseña o PIN de seguridad incorrecto";
    }
}

// Pausar o reiniciar el temporizador
if (isset($_POST['pause'])) {
    echo "Temporizador pausado";
} elseif (isset($_POST['restart'])) {
    echo "Temporizador reiniciado";
}
?>