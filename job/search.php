<?php
// Configuración de la base de datos (misma configuración que en tu código principal)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p";

// Inicializa la conexión a la base de datos utilizando PDO
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}

if (isset($_POST['search_term'])) {
    $search_term = $_POST['search_term'];

    // Definir la consulta SQL para buscar productos en todas las tablas
    $sql = "SELECT * FROM costilla WHERE descripcion LIKE :descripcion
            UNION
            SELECT * FROM extra WHERE descripcion LIKE :descripcion
            UNION
            SELECT * FROM sin_promo WHERE descripcion LIKE :descripcion
            UNION
            SELECT * FROM pollos WHERE descripcion LIKE :descripcion";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':descripcion', '%' . $search_term . '%', PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        foreach ($results as $result) {
            echo '<li>' . $result['descripcion'] . '
                <form method="post">
                    <input type="hidden" name="product_id" value="' . $result['id'] . '">
                    <button type="submit" class="btn btn-primary custom-btn-blue" name="add_to_cart">Agregar</button>
                </form>
            </li>';
        }
    } else {
        echo '<li>No se encontraron resultados.</li>';
    }
}
?>
