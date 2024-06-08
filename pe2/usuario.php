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
        <main>
            <?php 
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                // Redirigir a la página de inicio de sesión si no hay un usuario en la sesión
                if (!isset($_SESSION['usuario'])) {
                    header("Location: index.php");
                    exit();
                }

                // Conexión a la base de datos
                require 'conexionbd.php';

                try {

                    // Obtener los datos del usuario
                    $nombreusuario = $_SESSION['usuario'];
                    $sql_usuario = "SELECT * FROM Usuarios WHERE nombreusuario = :nombreusuario";
                    $stmt_usuario = $conexion->prepare($sql_usuario);
                    $stmt_usuario->bindParam(':nombreusuario', $nombreusuario);
                    $stmt_usuario->execute();
                    $usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

                    // Obtener los comentarios del usuario
                    $sql_comentarios = "SELECT * FROM Comentarios WHERE usuario = :nombreusuario ORDER BY fecha_comentario DESC";
                    $stmt_comentarios = $conexion->prepare($sql_comentarios);
                    $stmt_comentarios->bindParam(':nombreusuario', $nombreusuario);
                    $stmt_comentarios->execute();
                    $comentarios = $stmt_comentarios->fetchAll(PDO::FETCH_ASSOC);

                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    die();
                }
            ?>
            <section id="modificar-usuario">
                <h2>Editar Datos del Usuario</h2>
                <section id="datos-usuario">
                    <form id="formulario-modificar-usuario" method="post" action="actualizarusuario.php">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>">

                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>">

                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>">

                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">

                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?>">

                        <label for="comunidad_autonoma">Comunidad Autónoma:</label>
                        <input type="text" id="comunidad_autonoma" name="comunidad_autonoma" value="<?php echo htmlspecialchars($usuario['comunidad_autonoma']); ?>">

                        <label for="provincia">Provincia:</label>
                        <input type="text" id="provincia" name="provincia" value="<?php echo htmlspecialchars($usuario['provincia']); ?>">

                        <label for="imagen">Imagen (URL):</label>
                        <input type="text" id="imagen" name="imagen" value="<?php echo htmlspecialchars($usuario['imagen']); ?>">


                        <input type="submit" value="Actualizar Datos" id="actualizar-datos">
                    </form>
                    <section id="cambios">
                        <article id="cambiar-contraseña">
                            <p>¿Quieres modificar la contraseña?</p>
                            <a href="cambiar_contrasenia.php" id="boton-modificar-contraseña" >Modificar contraseña</a>
                        </article>
                        <article id="eliminar-cuenta">
                            <p>¿Deseas eliminar tu cuenta?</p>
                            <a href="eliminar_cuenta.php" id="boton-eliminar-cuenta" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">Eliminar Cuenta</a>
                        </article>
                    </section>
                </section>
            </section>
            <section id="comentarios-usuario">
                <h2>Comentarios Realizados</h2>
                <?php if (count($comentarios) > 0): ?>
                    <ul>
                        <?php foreach ($comentarios as $comentario): ?>
                            <article >
                                <p><?php echo htmlspecialchars($comentario['sugerencia']); ?></p>
                                <form method="post" action="eliminar_comentario.php" id="eliminarcomentario" >
                                    <input type="hidden" name="comentario_id" value="<?php echo $comentario['comentario_id']; ?>">
                                    <input type="submit" value="Eliminar comentario" onclick="return confirm('¿Estás seguro de que deseas eliminar el comentario?');">
                                </form>
                            </article>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No has realizado ningún comentario.</p>
                <?php endif; ?>
            </section>
        </main>
        <footer>
            <a href="contacto.php">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
        <script>
            document.getElementById('formulario-modificar-usuario').addEventListener('submit', function(event) {
                // Prevenir el envío del formulario
                event.preventDefault();

                // Obtener los valores de los campos del formulario
                const nombre = document.getElementById('nombre').value.trim();
                const apellidos = document.getElementById('apellidos').value.trim();
                const correo = document.getElementById('correo').value.trim();
                const telefono = document.getElementById('telefono').value.trim();
                const fecha_nacimiento = document.getElementById('fecha_nacimiento').value.trim();
                const comunidad_autonoma = document.getElementById('comunidad_autonoma').value.trim();
                const provincia = document.getElementById('provincia').value.trim();
                const imagen = document.getElementById('imagen').value.trim();

                // Verificar si algún campo está vacío
                if (nombre === '' || apellidos === '' || correo === '' || telefono === '' || fecha_nacimiento === '' || comunidad_autonoma === '' || provincia === '' || imagen === '') {
                    alert('Todos los campos son obligatorios.');
                    return;
                }

                // Si no hay campos vacíos, enviar el formulario
                this.submit();
            });
        </script>

    </body>
</html>
