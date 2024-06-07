<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Museo ArteVivo</title>
    <link rel="icon" type="image/png" href="imagenes/logo.png">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="smallindex.css" type="text/css" rel="stylesheet" media="(max-width: 1511px)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function validarFormulario(event) {
            event.preventDefault(); // Prevenir el envío del formulario

            // Obtener los valores de los campos
            const contrasenaActual = document.getElementById('contrasena_actual').value;
            const nuevaContrasena = document.getElementById('nueva_contrasena').value;
            const confirmarContrasena = document.getElementById('confirmar_contrasena').value;

            // Validar que los campos no estén vacíos
            if (!contrasenaActual || !nuevaContrasena || !confirmarContrasena) {
                alert('Todos los campos son obligatorios.');
                return;
            }

            // Validar que las nuevas contraseñas coincidan
            if (nuevaContrasena !== confirmarContrasena) {
                alert('Las nuevas contraseñas no coinciden.');
                return;
            }

            // Realizar la validación de la contraseña actual con JavaScript (opcional)
            fetch('verificar_contraseña_actual.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'contrasena_actual=' + encodeURIComponent(contrasenaActual)
            })
            .then(response => response.json())
            .then(data => {
                if (!data.valida) {
                    alert('La contraseña actual no es correcta.');
                } else {
                    // Si la contraseña actual es correcta, enviar el formulario
                    document.getElementById('form-cambiar-contrasenia').submit();
                }
            })
            .catch(error => {
                console.error('Error al validar la contraseña:', error);
            });
        }
    </script>
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
        <h2>Cambiar Contraseña</h2>
        <?php
            if (isset($_SESSION['mensaje_error'])) {
                echo "<p style='color:red'>" . $_SESSION['mensaje_error'] . "</p>";
                unset($_SESSION['mensaje_error']);
            }
        ?>
        <form id="form-cambiar-contrasenia" action="cambiar_contraseniabd.php" method="post" onsubmit="validarFormulario(event)">
            <label for="contrasena_actual">Contraseña Actual:</label>
            <input type="password" id="contrasena_actual" name="contrasena_actual">

            <label for="nueva_contrasena">Nueva Contraseña:</label>
            <input type="password" id="nueva_contrasena" name="nueva_contrasena">

            <label for="confirmar_contrasena">Confirmar Nueva Contraseña:</label>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena">

            <input type="submit" value="Actualizar Contraseña">
        </form>
    </main>
    <footer>
        <a href="contacto.php">Contacto</a>
        <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
    </footer>
</body>
</html>
