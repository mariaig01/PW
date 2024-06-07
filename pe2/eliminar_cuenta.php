<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Conexión a la base de datos
require 'conexionbd.php';

try {
    $nombreusuario = $_SESSION['usuario'];

    // Eliminar los comentarios del usuario
    $sql_comentarios = "DELETE FROM Comentarios WHERE usuario = :nombreusuario";
    $stmt_comentarios = $conexion->prepare($sql_comentarios);
    $stmt_comentarios->bindParam(':nombreusuario', $nombreusuario);
    $stmt_comentarios->execute();

    // Eliminar el usuario
    $sql_usuario = "DELETE FROM Usuarios WHERE nombreusuario = :nombreusuario";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bindParam(':nombreusuario', $nombreusuario);
    $stmt_usuario->execute();

    // Cerrar sesión y redirigir a la página principal
    session_destroy();
    header("Location: index.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>
