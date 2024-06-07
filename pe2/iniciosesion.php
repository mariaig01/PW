<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'conexionbd.php';

    $nombreusuario = $_POST['usuario'];
    $contrasenia = $_POST['contraseña'];
    $es_registro = isset($_POST['registro']) && $_POST['registro'] == 'true';

    $sql = "SELECT * FROM Usuarios WHERE nombreusuario = :nombreusuario";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombreusuario', $nombreusuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar la contraseña
        if (password_verify($contrasenia, $usuario['contrasenia'])) {
            $_SESSION['usuario'] = $nombreusuario;
            $_SESSION['es_administrador'] = $usuario['es_administrador'];
            $_SESSION['mensaje_bienvenida'] = "Bienvenido, $nombreusuario";
            $_SESSION['imagen'] = $usuario['imagen']; 

            if ($es_registro) {
                header("Location: altaexitosa.php");
            } else {
                header("Location: index.php");
            }
            unset($_SESSION['error_login']); 
            exit();
        } else {
            $_SESSION['error_login'] = "Usuario o contraseña incorrecto.";
            header("Location: index.php");
        }
    } else {
        $_SESSION['error_login'] = "Usuario o contraseña incorrecto.";
        header("Location: index.php");
    }

    $conexion = null;
}

?>

