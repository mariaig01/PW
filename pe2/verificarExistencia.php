<?php

    // Verificar que se haya proporcionado un campo y un valor
    if (isset($_GET['campo']) && isset($_GET['valor'])) {
        $campo = $_GET['campo'];
        $valor = $_GET['valor'];

        try {
            require 'conexionbd.php';

            $sql = "SELECT COUNT(*) FROM Usuarios WHERE $campo = :valor";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':valor', $valor);
            $stmt->execute();

            // Obtener el número de registros que coinciden
            $count = $stmt->fetchColumn();

            $response = array('existe' => $count > 0);

            echo json_encode($response);

        } catch (PDOException $e) {
            echo json_encode(array('error' => $e->getMessage()));
        }
    } 
    else {
        echo json_encode(array('error' => 'Parámetros inválidos'));
    }
?>
