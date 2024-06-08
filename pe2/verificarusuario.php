<?php
    // Verificar si el nombre de usuario ya está en uso
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombreusuario'])) {
        require 'conexionbd.php';
        
        $nombreusuario = $_GET['nombreusuario'];
        $sql = "SELECT COUNT(*) AS count FROM Usuarios WHERE nombreusuario = :nombreusuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombreusuario', $nombreusuario);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolver respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['disponible' => ($row['count'] == 0)]);
    }
?>
