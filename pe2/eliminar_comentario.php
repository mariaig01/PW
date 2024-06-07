<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logeado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Conexión a la base de datos
require 'conexionbd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario_id'])) {
    $comentario_id = $_POST['comentario_id'];
    $usuario = $_SESSION['usuario'];

    try {
        // Verificar que el comentario pertenece al usuario logeado
        $sql = "DELETE FROM Comentarios WHERE comentario_id = :comentario_id AND usuario = :usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':comentario_id', $comentario_id);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['mensaje'] = "Comentario eliminado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar el comentario.";
        }
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    }

    header("Location: usuario.php");
    exit();
}
?>
