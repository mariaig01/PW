<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Museo ArteVivo</title>
    <link rel="icon" type="image/png" href="imagenes/logo.png">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="smallindex.css" type="text/css" rel="stylesheet" media="(max-width: 1511px)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <section>
            <img class="logo" src="imagenes/logo.png" alt="Logo del museo">
            <h1 class="nombre">Museo ArteVivo</h1>
            <?php include 'formularioinicio.php' ?>
        </section>
        <nav class="menu">
            <ul>
                <li><a href="index.php" >Inicio</a></li>
                <li><a href="coleccion.php">Colección</a></li>
                <li><a href="visita.php">Visita</a></li>
                <li><a href="exposiciones.php">Exposiciones</a></li>
                <li><a href="informacion.php">Información general</a></li>
                <li><a href="experiencias.php" >Experiencias</a></li>
            </ul>
        </nav>
    </header>
    <main id="editar-obra">
        <h2>Editar obra</h2>
        <?php
            require 'conexionbd.php';

            // Obtener el ID de la obra de la URL
            $id = isset($_GET['id']) ? $_GET['id'] : null;

            if ($id) {
                try {
                    $sql = "SELECT * FROM Obras WHERE id = :id";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $obra = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($obra) {
                        // Mostrar el formulario de edición de la obra
                        echo '<form id="form-editar-obra" method="post" action="editarobrabd.php" onsubmit="return validarFormulario(event)">';
                        echo '<input type="hidden" name="id" value="' . $obra['id'] . '">';
                        echo '<label for="titulo">Título:</label>';
                        echo '<input type="text" name="titulo" id="titulo" value="' . htmlspecialchars($obra['titulo']) . '">';
                        echo '<label for="autor">Autor:</label>';
                        echo '<input type="text" name="autor" id="autor" value="' . htmlspecialchars($obra['autor']) . '">';
                        echo '<label for="tema">Tema:</label>';
                        echo '<input type="text" name="tema" id="tema" value="' . htmlspecialchars($obra['tema']) . '">';
                        echo '<label for="epoca">Época:</label>';
                        echo '<input type="text" name="epoca" id="epoca" value="' . htmlspecialchars($obra['epoca']) . '">';
                        echo '<label for="descripcion">Descripción:</label>';
                        echo '<textarea name="descripcion" id="descripcion">' . htmlspecialchars($obra['descripcion']) . '</textarea>';
                        echo '<label for="imagen">Imagen (URL en el servidor):</label>';
                        echo '<input type="text" name="imagen" id="imagen" value="' . htmlspecialchars($obra['imagen']) . '">';
                        echo '<input type="submit" value="Guardar cambios" id="boton-guardar-cambios">';
                        echo '</form>';
                    } else {
                        echo '<p>No se encontró la obra.</p>';
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conexion = null;
            } else {
                echo '<p>No se proporcionó el ID de la obra.</p>';
            }
        ?>
    </main>
    <footer>
        <a href="contacto.php">Contacto</a>
        <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
    </footer>
    <script>
        function validarFormulario(event) {
            event.preventDefault(); // Prevenir el envío del formulario

            // Obtener los valores de los campos
            const titulo = document.getElementById('titulo').value.trim();
            const autor = document.getElementById('autor').value.trim();
            const epoca = document.getElementById('epoca').value.trim();
            const tema = document.getElementById('tema').value.trim();
            let imagen = document.getElementById('imagen').value.trim();
            const descripcion = document.getElementById('descripcion').value.trim();

            // Validar que los campos no estén vacíos
            if (!titulo || !autor || !epoca || !tema || !imagen || !descripcion) {
                alert('Todos los campos son obligatorios.');
                return;
            }

            // Validar que la URL de la imagen tenga la forma correcta
            const baseURL = 'http://bahia.ugr.es/~angustias16/pe2/imagenes/';
            if (!imagen.startsWith(baseURL)) {
                imagen = baseURL + imagen;
            }

            // Actualizar el campo de la imagen con la URL completa
            document.getElementById('imagen').value = imagen;

            // Validar si el título ya existe en la base de datos
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'validartituloObra.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.exists) {
                        alert('El título ya existe en la base de datos.');
                    } else {
                        // Si el título no existe, enviar el formulario
                        document.getElementById('form-editar-obra').submit();
                    }
                } else {
                    alert('Error al verificar el título. Inténtelo de nuevo más tarde.');
                }
            };
            xhr.send('titulo=' + encodeURIComponent(titulo));
        }
    </script>
</body>
</html>
