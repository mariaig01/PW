<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contrasena_actual = $_POST['contrasena_actual'];
    $nombreusuario = $_SESSION['usuario'];

    $stmt = $conexion->prepare("SELECT contrasenia FROM Usuarios WHERE nombreusuario = :nombreusuario");
    $stmt->bindParam(':nombreusuario', $nombreusuario);
    $stmt->execute();
    $resultado = $stmt->fetch();

    if ($resultado && password_verify($contrasena_actual, $resultado['contrasenia'])) {
        echo json_encode(['valida' => true]);
    } else {
        echo json_encode(['valida' => false]);
    }
}
?>
