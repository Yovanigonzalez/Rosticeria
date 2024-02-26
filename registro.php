<?php
session_start(); // Iniciar la sesión

// Verificar si hay un mensaje de error almacenado en la sesión
if(isset($_SESSION['login_error']) && !empty($_SESSION['login_error'])) {
    $errorMessage = $_SESSION['login_error'];
    // Limpiar el mensaje de error de la sesión para que no se muestre en futuras cargas de la página
    unset($_SESSION['login_error']);
} else {
    $errorMessage = ""; // Si no hay mensaje de error, dejarlo vacío
}

// Continúa con el resto del código HTML
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Punto de Venta - Registro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="log/log.jpg">

    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .section-container {
            display: flex;
        }

        .section {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
        }

        /* Estilo personalizado para el botón */
        .btn-custom {
            background-color: #2C1BE4;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Layout and SVG -->
    <div style="width: 100%; height: 100%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 35" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 7.17639L60 12.0163C120 16.8562 240 26.3691 360 31.209C480 36.0489 600 36.0489 720 32.3772C840 28.8725 960 21.6961 1080 20.3609C1200 19.1927 1320 24.0326 1380 26.3691L1440 28.8725V0H1380C1320 0 1200 0 1080 0C960 0 840 0 720 0C600 0 480 0 360 0C240 0 120 0 60 0H0V7.17639Z" fill="#2C1BE4"/>
        </svg>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="section-container">
                            <!-- ... -->

                            <!-- Nueva sección para el formulario de registro -->
                            <section class="section">
                                <h2 align="center" class="mb-4">Registrarse</h2>
                                <!-- Aquí podrías mostrar un mensaje de éxito o error del registro -->
                                <form action="register_process.php" method="POST">
                                    <div class="form-group">
                                        <label for="username">
                                            <i class="fas fa-user"></i> Nombre de usuario:
                                        </label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                            <i class="fas fa-envelope"></i> Correo electrónico:
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">
                                            <i class="fas fa-lock"></i> Contraseña:
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-custom btn-block">
                                        <i class="fas fa-user-plus"></i> Registrarse
                                    </button>
                                </form>
                            </section>
                            <!-- Fin de la nueva sección -->

                            <!-- ... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap JS (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
