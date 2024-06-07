<?php
require 'conexionbd.php';

// Obtener el ID de la obra de la URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    try {
        $sql = "DELETE FROM Obras WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir a la página de la colección después de eliminar la obra
        header('Location: coleccion.php');
        exit;
    } catch (PDOException $e) {
        echo "Error al eliminar la obra: " . $e->getMessage();
    }
} else {
    echo "No se proporcionó el ID de la obra.";
}

$conexion = null;
?>