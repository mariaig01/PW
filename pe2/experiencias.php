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
                <form class="formulariousuario">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" required>
                
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" name="contraseña" id="contraseña" required>
                    
                    
                    <input type="submit" value="Iniciar sesión" class="iniciosesion">
                    <p>¿No dispones de cuenta?</p>
                    <a href="altausuarios.php">Regístrate</a>
                </form>
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
                <article>
                    <figure class="fotoynombre">
                        <img src="imagenes/usuario.jpg" alt="Foto de usuario">
                        <figcaption>Juan Ruiz</figcaption>
                    </figure>
                    <p>Me gustaría que el Museo ArteVivo ofreciera visitas guiadas en inglés para los turistas extranjeros. Creo que sería una buena forma de promocionar el museo y de atraer a más visitantes.</p>
                </article>
                <article>
                    <figure class="fotoynombre">
                        <img src="imagenes/usuario.jpg" alt="Foto de usuario">
                        <figcaption>Juan Ruiz</figcaption>
                    </figure>
                    <p>Me gustaría que el Museo ArteVivo ofreciera visitas guiadas en inglés para los turistas extranjeros. Creo que sería una buena forma de promocionar el museo y de atraer a más visitantes.</p>
                </article>
            </section>
            <section id="sugerencias">
                <h2>Buzón</h2>
                <p>¿Te gustaría enviar una sugerencia u opinión?</p>
                <form action="procesar.php" method="post">
                
                    <label for="sugerencia">Sugerencia/opinión:</label>
                    <textarea id="sugerencia" name="sugerencia" required></textarea>
                
                    <input type="submit" value="Enviar sugerencia">
                </form>
            </section>
        </main>
        <footer>
            <a href="contacto.html">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
    </body>
</html>