<?php
require 'conexionbd.php'; // Archivo de conexión a la base de datos

$titulo = $_POST['titulo'];
$response = ['exists' => false];

try {
    $stmt = $conexion->prepare("SELECT COUNT(*) FROM Obras WHERE titulo = :titulo");
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $response['exists'] = true;
    }

    echo json_encode($response);
} catch (PDOException $e) {
    // Registrar el error en un archivo
    echo json_encode(['error' => $e->getMessage()]);
}
?>