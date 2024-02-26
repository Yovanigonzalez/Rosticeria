<?php
session_start();

include 'sql/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener la entrada del usuario desde el formulario de inicio de sesión
    $inputEmail = $_POST['email_phone'];
    $inputPassword = $_POST['password'];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$inputEmail'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        // Usuario encontrado, verificar la contraseña
        $fila = $resultado->fetch_assoc();
        $passwordHashed = $fila['password'];

        // Verificar la contraseña
        if (password_verify($inputPassword, $passwordHashed)) {
            // Inicio de sesión exitoso
            // Establecer los datos del usuario en la sesión si es necesario
            $_SESSION['user_id'] = $fila['id'];
            $_SESSION['user_email'] = $fila['email'];
            $_SESSION['user_role'] = $fila['rol'];

            // Redireccionar según el rol del usuario
            if ($_SESSION['user_role'] == 'admin') {
                header('Location: admin/inicio.php');
            } elseif ($_SESSION['user_role'] == 'super') {
                header('Location: Superior/editar.php');
            } elseif ($_SESSION['user_role'] == 'job') {
                header('Location: job/venta.php');
            } else {
                header('Location: dashboard.php'); // Rol no reconocido, redirigir a una página por defecto
            }
            exit();
        } else {
            // Inicio de sesión fallido - contraseña incorrecta
            $_SESSION['login_error'] = 'Contraseña incorrecta';
            header('Location: login.php'); // Redirigir de nuevo a la página de inicio de sesión
            exit();
        }
    } else {
        // Inicio de sesión fallido - usuario no encontrado
        $_SESSION['login_error'] = 'Usuario no encontrado';
        header('Location: login.php'); // Redirigir de nuevo a la página de inicio de sesión
        exit();
    }
} else {
    // Redirigir a la página de inicio de sesión si se accede directamente sin una solicitud POST
    header('Location: index.php');
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
