<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $epoca = $_POST['epoca'];
    $imagen = $_POST['imagen']; // URL de la imagen en el servidor
    $tema = $_POST['tema'];
    $descripcion = $_POST['descripcion'];

    // Insertar los datos en la base de datos
    try {
        // Conexión a la base de datos
        require 'conexionbd.php';

        // Consulta SQL para insertar la nueva obra
        $sql = "INSERT INTO Obras (titulo, autor, epoca, imagen, tema, descripcion) VALUES (:titulo, :autor, :epoca, :imagen, :tema, :descripcion)";

        // Preparar la consulta
        $stmt = $conexion->prepare($sql);
        // Enlazar los parámetros
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':epoca', $epoca);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':tema', $tema);
        $stmt->bindParam(':descripcion', $descripcion);

        // Ejecutar la consulta
        $stmt->execute();

        // Redirigir a una página de éxito
        header("Location: coleccion.php");
        exit();
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
    }
}
?>
