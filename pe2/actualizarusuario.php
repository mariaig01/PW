<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require 'conexionbd.php';

    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $comunidad_autonoma = $_POST['comunidad_autonoma'];
    $provincia = $_POST['provincia'];
    $nombreusuario = $_SESSION['usuario'];
    $imagen = $_POST['imagen']; 

    // Actualizar datos
    $sql = "UPDATE Usuarios SET nombre=:nombre, apellidos=:apellidos, correo=:correo, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, comunidad_autonoma=:comunidad_autonoma, provincia=:provincia, imagen=:imagen WHERE nombreusuario=:nombreusuario";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':comunidad_autonoma', $comunidad_autonoma);
    $stmt->bindParam(':provincia', $provincia);
    $stmt->bindParam(':nombreusuario', $nombreusuario);
    $stmt->bindParam(':imagen', $imagen);

    if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos.";
    }
   
    $_SESSION['imagen'] = $imagen;

    header("Location: usuario.php");
    $conexion = null;
}
?>
