<?php
require 'conexionbd.php';

// Obtener los datos del formulario
$id = isset($_POST['id']) ? $_POST['id'] : null;
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
$autor = isset($_POST['autor']) ? $_POST['autor'] : null;
$tema = isset($_POST['tema']) ? $_POST['tema'] : null;
$epoca = isset($_POST['epoca']) ? $_POST['epoca'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;

if ($id && $titulo && $autor && $tema && $epoca && $descripcion && $imagen) {
    try {
        $sql = "UPDATE Obras SET titulo = :titulo, autor = :autor, tema = :tema, epoca = :epoca, descripcion = :descripcion, imagen = :imagen WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindValue(':autor', $autor, PDO::PARAM_STR);
        $stmt->bindValue(':tema', $tema, PDO::PARAM_STR);
        $stmt->bindValue(':epoca', $epoca, PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindValue(':imagen', $imagen, PDO::PARAM_STR);
        $stmt->execute();

        // Redirigir a la página de la obra después de actualizarla
        header('Location: obra.php?id=' . $id);
        exit;
    } catch (PDOException $e) {
        echo "Error al actualizar la obra: " . $e->getMessage();
    }
} else {
    echo "No se proporcionaron todos los datos necesarios para actualizar la obra.";
}

$conexion = null;
?>