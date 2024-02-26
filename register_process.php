<?php
session_start();

// Verificar si se han enviado datos mediante el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a tu base de datos (reemplaza con tus propias credenciales)

    include 'sql/conexion.php';
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener datos del formulario de registro
    $nombre = $_POST['username']; // Estoy usando 'username' porque parece ser el campo del formulario, cambiar según tus necesidades
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash de la contraseña (nunca guardes contraseñas en texto plano)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Asignar un rol por defecto (puedes cambiarlo según tus necesidades)
    $rol = 'usuario';

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$hashedPassword', '$rol')";

    if ($conn->query($sql) === TRUE) {
        // Éxito en el registro
        $_SESSION['registration_success'] = "¡Registro exitoso! Ahora puedes iniciar sesión.";
        header("Location: registro.php"); // Redirige a la página de inicio de sesión
        exit();
    } else {
        // Error en el registro
        $_SESSION['registration_error'] = "Error al registrar usuario. Intenta nuevamente.";
        header("Location: registro.php"); // Redirige de vuelta a la página de registro
        exit();
    }

    $conn->close();
} else {
    // Si intentan acceder directamente a este script sin enviar datos, redirige a la página de registro
    header("Location: registro.php");
    exit();
}
?>
