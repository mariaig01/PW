<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="es"> 
<head>
    <script>
        function validarFormulario(event) {

            const usuario = document.getElementById('usuario').value;
            const contrasena = document.getElementById('contraseña').value;

            if (!usuario || !contrasena) {
                alert('Ambos campos son obligatorios.');
                event.preventDefault(); 
            }
        }
    </script>
</head>
<body>
    <?php if (!isset($_SESSION['usuario'])): ?>
        <form class="formulariousuario" method="post" action="iniciosesion.php" onsubmit="validarFormulario(event)">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario">

            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña">
            
            <input type="submit" value="Iniciar sesión" class="iniciosesion">

            <?php
                if (isset($_SESSION['error_login'])) {
                    echo '<p class="error">' . $_SESSION['error_login'] . '</p>';
                    unset($_SESSION['error_login']);
                }
            ?>

            <p>¿No dispones de cuenta?</p>
            <a href="altausuarios.php">Regístrate</a>
        </form>
    <?php else: ?>
        <section id="usuario-inicio">
            <article id="iconousuario">
                <a href="usuario.php" >
                    <img src="imagenes/usuario.jpg" alt="icono usuario" id="icono-usuario">
                </a>
            </article>
            <figure id="usuariofigure">
                <img src="<?php echo $_SESSION['imagen']; ?>" alt="Imagen del usuario" id="imagenusuario">
                <p class="mensaje_bienvenida"><?php echo $_SESSION['mensaje_bienvenida']; ?></p>
            </figure>
            <form method="post" action="logout.php">
                <input type="submit" value="Cerrar sesión" class="cerrarsesion">
            </form>
        </section>
    <?php endif; ?>
</body>
</html>
