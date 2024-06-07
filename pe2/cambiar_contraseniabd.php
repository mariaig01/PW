<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Verificar si las nuevas contraseñas coinciden
    if ($nueva_contrasena != $confirmar_contrasena) {
        $_SESSION['mensaje_error'] = 'Las nuevas contraseñas no coinciden.';
        header("Location: cambiar_contrasenia.php");
        exit;
    }

    // Obtener la contraseña actual del usuario de la base de datos
    $nombreusuario = $_SESSION['usuario'];
    $stmt = $conexion->prepare("SELECT contrasenia FROM Usuarios WHERE nombreusuario = :nombreusuario");
    $stmt->bindParam(':nombreusuario', $nombreusuario);
    $stmt->execute();
    $resultado = $stmt->fetch();

    // Verificar la contraseña actual
    if (!$resultado || !password_verify($contrasena_actual, $resultado['contrasenia'])) {
        $_SESSION['mensaje_error'] = 'La contraseña actual no es correcta.';
        header("Location: cambiar_contrasenia.php");
        exit;
    }

    // Actualizar la contraseña
    $nueva_contrasena_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("UPDATE Usuarios SET contrasenia = :nueva_contrasena WHERE nombreusuario = :nombreusuario");
    $stmt->bindParam(':nueva_contrasena', $nueva_contrasena_hash);
    $stmt->bindParam(':nombreusuario', $nombreusuario);
    if ($stmt->execute()) {
        header("Location: usuario.php");
    } else {
        $_SESSION['mensaje_error'] = 'Error al actualizar la contraseña.';
        header("Location: cambiar_contrasenia.php");
    }
}
?>
