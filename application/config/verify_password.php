<?php
// Verificar la contraseña o PIN de seguridad
$password = $_POST['password'];

// Verificar la contraseña o PIN de seguridad con la base de datos
// (suponiendo que tienes una tabla "users" con una columna "password")
$query = "SELECT * FROM users WHERE password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Iniciar la sesión
    session_start();
    $_SESSION['logged_in'] = true;
    $_SESSION['password'] = $password;
    header('Location: timer.php');
    exit;
} else {
    echo "Contraseña o PIN de seguridad incorrecto";
}
?>