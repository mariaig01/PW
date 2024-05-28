<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Obra 1</title>
        <link rel="icon" type="image/png" href="imagenes/logo.png">
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
        <main>
            <figure>
                <img src="imagenes/adoracion.jpg" class="imagenobra" alt="Imagen de adoracion">
            </figure>
            <section class="fichayobra">
                <article class="ficha-tecnica">
                    <h3>Adoración a los reyes magos</h3>
                    <p>Leonardo da Vinci</p>
                    <p>Óleo sobre tabla</p>
                    <p>Siglo XVI</p>
                    <p>En la composición de la "Adoración de los Reyes Magos", generalmente se observa a los tres Magos 
                        en actitud de veneración, ofreciendo sus regalos al niño Jesús, quien suele estar en el regazo 
                        de la Virgen María. José, el esposo de María, a menudo también está presente, aunque típicamente 
                        en un papel más secundario.</p>
                </article>
                <aside class="obrasrelacionadas">
                    <nav >
                        <h3>Obras Relacionadas</h3>
                        <ul>
                            <li><a href="obra2.html">Obra 1</a></li>
                            <li><a href="obra2.html">Obra 2</a></li>
                            <li><a href="obra2.html">Obra 3</a></li>
                            <li><a href="obra2.html">Obra 4</a></li>
                            <li><a href="obra2.html">Obra 5</a></li>
                        </ul>
                    </nav>
                </aside>
            </section>
        </main>
        <footer>
            <a href="contacto.html">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
    </body>
</html>