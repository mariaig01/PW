<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Experiencias</title>
        <link rel="icon" type="image/png" href="imagenes/logo.png">
        <link rel="stylesheet" type="text/css" href="styles.css">
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
        <main id="opinionesysugerencias">
            <section id="opiniones">
                <h2>Opiniones y sugerencias</h2>
                <?php
                require 'conexionbd.php';
                $sql = "SELECT Comentarios.usuario, Comentarios.sugerencia, Usuarios.imagen 
                        FROM Comentarios 
                        INNER JOIN Usuarios ON Comentarios.usuario = Usuarios.nombreusuario 
                        ORDER BY Comentarios.fecha_comentario DESC"; 
                        
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<article>';
                    echo '<figure class="fotoynombre">';
                    echo '<img src="' . htmlspecialchars($row['imagen']) . '" alt="Foto de usuario">';
                    echo '<figcaption>' . htmlspecialchars($row['usuario']) . '</figcaption>';
                    echo '</figure>';
                    echo '<p>' . htmlspecialchars($row['sugerencia']) . '</p>';
                    echo '</article>';
                }
                ?>
            </section>
            <section id="sugerencias">
                <h2>Buzón</h2>
                <p>¿Te gustaría enviar una sugerencia u opinión?</p>
                <?php
                    if (isset($_SESSION['usuario'])) { // Verificar si el usuario está logeado
                        ?>
                        <form id="form-sugerencia" action="registrosugerencia.php" method="post">
                            <label for="sugerencia">Sugerencia/opinión:</label>
                            <textarea id="sugerencia" name="sugerencia" ></textarea>
                            <input type="submit" value="Enviar sugerencia">
                        </form>
                        <?php
                    } else {
                        echo "<p>Para enviar una sugerencia, debes iniciar sesión.</p>";
                    }
                ?>
            </section>
        </main>
        <footer>
            <a href="contacto.php">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
        
        <script>
            document.getElementById('form-sugerencia').addEventListener('submit', function(event) {
                var sugerencia = document.getElementById('sugerencia').value.trim();
                if (sugerencia.length < 50) {
                    event.preventDefault(); // Evita el envío del formulario
                    alert('Por favor, ingresa una sugerencia de al menos 50 caracteres antes de enviar.');
                }
            });
        </script>
    </body>
</html>
