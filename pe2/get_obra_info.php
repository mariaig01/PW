<?php
require 'conexionbd.php'; 

$id = $_GET['id'];

try {
    $sql = "SELECT titulo, tema FROM Obras WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $obra = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($obra);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conexion = null;
?>