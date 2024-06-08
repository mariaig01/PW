<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'conexionbd.php';

    $sugerencia = $_POST['sugerencia'];
    $fecha_actual = date('Y-m-d H:i:s'); // Obtiene la fecha y hora actual

    
    $sql = "INSERT INTO Comentarios (usuario, sugerencia, fecha_comentario) VALUES (:usuario, :sugerencia, :fecha_comentario)";
  
    $stmt = $conexion->prepare($sql);
  
    $stmt->bindValue(':usuario', $_SESSION['usuario']);
    $stmt->bindValue(':sugerencia', $sugerencia);
    $stmt->bindValue(':fecha_comentario', $fecha_actual); // Vincula la fecha actual
  

    if ($stmt->execute()) {
        header("Location: experiencias.php"); // Redirige de nuevo a la página de experiencias
    } else {
        echo "<p>Error al enviar la sugerencia.</p>";
    }
  
    $stmt = null;
    $conexion = null;
}
?>
