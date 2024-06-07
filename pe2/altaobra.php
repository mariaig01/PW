<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Alta Obra</title>
    <link rel="icon" type="image/png" href="imagenes/logo.png">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <section>
            <img class="logo" src="imagenes/logo.png" alt="Logo del museo">
            <h1 class="nombre">Museo ArteVivo</h1>
            <?php include 'formularioinicio.php'; ?>
        </section>
        <nav class="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="coleccion.php">Colección</a></li>
                <li><a href="visita.php">Visita</a></li>
                <li><a href="exposiciones.php">Exposiciones</a></li>
                <li><a href="informacion.php">Información general</a></li>
                <li><a href="experiencias.php">Experiencias</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="altaobra">
            <h2>Dar de alta una obra</h2>
            <form id="form-alta-obra" method="post" action="altaobrabd.php" onsubmit="validarFormulario(event)">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo">
            
                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor">
            
                <label for="epoca">Época:</label>
                <input type="text" name="epoca" id="epoca">

                <label for="tema">Tema:</label>
                <input type="text" name="tema" id="tema">
            
                <label for="imagen">Imagen (URL en el servidor):</label>
                <input type="text" name="imagen" id="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion"></textarea>
            
                <input type="submit" value="Dar de alta" id="boton-alta-obra">
            </form>
        </section>
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
                        document.getElementById('form-alta-obra').submit();
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
