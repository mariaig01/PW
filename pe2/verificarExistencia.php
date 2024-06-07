<?php
// verificarExistencia.php

// Verificar que se haya proporcionado un campo y un valor
if (isset($_GET['campo']) && isset($_GET['valor'])) {
    $campo = $_GET['campo'];
    $valor = $_GET['valor'];

    try {
        // Conexión a la base de datos
        require 'conexionbd.php';

        // Preparar la consulta SQL dependiendo del campo proporcionado
        $sql = "SELECT COUNT(*) FROM Usuarios WHERE $campo = :valor";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();

        // Obtener el número de registros que coinciden
        $count = $stmt->fetchColumn();

        // Preparar la respuesta JSON
        $response = array('existe' => $count > 0);

        // Enviar la respuesta JSON
        echo json_encode($response);

    } catch (PDOException $e) {
        // Manejo de errores
        echo json_encode(array('error' => $e->getMessage()));
    }
} else {
    // Respuesta en caso de que falten parámetros
    echo json_encode(array('error' => 'Parámetros inválidos'));
}
?>
