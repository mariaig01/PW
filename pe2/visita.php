<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Visita</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <section>
                <img class="logo" src="imagenes/logo.png" alt="Logo del museo">
                <h1 class="nombre">Museo ArteVivo</h1>
                <form class="formulariousuario">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario"  required>
                
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
        <main>
            <section id="salas">
                <h2>Salas del Museo</h2>
                <article id="articlesala">
                    <article>
                        <h3>Sala de Arte Moderno</h3>
                        <img src="imagenes/Dioniso.jpg" alt="Imagen dioniso">
                        <p>Explora las tendencias artísticas desde el siglo XX hasta la actualidad, con obras destacadas de artistas nacionales e internacionales.</p>
                    </article>
                    <article>
                        <h3>Sala de Esculturas</h3>
                        <img src="imagenes/Dioniso.jpg" alt="Imagen dioniso">
                        <p>Dedicada a la exposición de esculturas clásicas y contemporáneas, esta sala ofrece un viaje por las tres dimensiones del arte.</p>
                    </article>
                    <article>
                        <h3>Sala de Arte Abstracto</h3>
                        <img src="imagenes/Dioniso.jpg" alt="Imagen dioniso">
                        <p>Esta sala muestra una colección de obras abstractas que desafían la percepción tradicional del arte visual.</p>
                    </article>
                    <article>
                        <h3>Sala de Arte Renacentista</h3>
                        <img src="imagenes/Dioniso.jpg" alt="Imagen dioniso">
                        <p>Esta sala muestra una colección de obras abstractas que desafían la percepción tradicional del arte visual.</p>
                    </article>
                    <article>
                        <h3>Sala de Arte Abstracto</h3>
                        <img src="imagenes/Dioniso.jpg" alt="Imagen dioniso">
                        <p>Esta sala muestra una colección de obras abstractas que desafían la percepción tradicional del arte visual.</p>
                    </article>
                    <article>
                        <h3>Sala de Arte Renacentista</h3>
                        <img src="imagenes/Dioniso.jpg" alt="Imagen dioniso">
                        <p>Esta sala muestra una colección de obras abstractas que desafían la percepción tradicional del arte visual.</p>
                    </article>
                </article>
            </section>
            <section id="plano">
                <h2>Plano del Museo</h2>
                <p>A continuación, se muestra el plano del museo para facilitar su visita y exploración de nuestras salas.</p>
                <img src="imagenes/plano-museo.jpg" alt="Plano del Museo ArteVivo">
            </section>
        </main>
        <footer>
            <a href="contacto.html">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
    </body>
</html>