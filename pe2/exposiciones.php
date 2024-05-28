<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Exposiciones</title>
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
        <main>
            <h2>Exposiciones</h2>
                <article class="exposicion">
                    <figure >
                        <img src="imagenes/bodegon.jpg" alt="Descripción de la imagen">
                        <figcaption>
                            Tres jarrones y una taza sobre una mesa
                        </figcaption>
                    </figure>
                    <section>
                        <p class="descripcion">Francisco de Zurbarán</p>
                        <p class="descripcion">Bodegón</p>
                        <p class="descripcion">Siglo XVI</p>
                        <p class="resumen">La pintura muestra una sencilla composición de tres jarrones y una taza sobre una mesa de madera. 
                            Los jarrones son de diferentes formas y tamaños, y están hechos de cerámica vidriada. La taza es de metal 
                            y tiene un asa. Los objetos están dispuestos sobre la mesa de forma equilibrada y armónica. La iluminación natural 
                            proviene de una ventana que se encuentra fuera del cuadro.</p>
                    </section>
                </article>
                <article class="exposicion">
                    <figure >
                        <img src="imagenes/bodegon.jpg" alt="Descripción de la imagen">
                        <figcaption>
                            Tres jarrones y una taza sobre una mesa
                        </figcaption>
                    </figure>
                    <section>
                        <p class="descripcion">Francisco de Zurbarán</p>
                        <p class="descripcion">Bodegón</p>
                        <p class="descripcion">Siglo XVI</p>
                        <p class="resumen">La pintura muestra una sencilla composición de tres jarrones y una taza sobre una mesa de madera. 
                            Los jarrones son de diferentes formas y tamaños, y están hechos de cerámica vidriada. La taza es de metal 
                            y tiene un asa. Los objetos están dispuestos sobre la mesa de forma equilibrada y armónica. La iluminación natural 
                            proviene de una ventana que se encuentra fuera del cuadro.</p>
                    </section>
                </article>
                <article class="exposicion">
                    <figure>
                        <img src="imagenes/bodegon.jpg" alt="Descripción de la imagen">
                        <figcaption>
                            Tres jarrones y una taza sobre una mesa
                        </figcaption>
                    </figure>
                    <section>
                        <p class="descripcion">Francisco de Zurbarán</p>
                        <p class="descripcion">Bodegón</p>
                        <p class="descripcion">Siglo XVI</p>
                        <p class="resumen">La pintura muestra una sencilla composición de tres jarrones y una taza sobre una mesa de madera. 
                            Los jarrones son de diferentes formas y tamaños, y están hechos de cerámica vidriada. La taza es de metal 
                            y tiene un asa. Los objetos están dispuestos sobre la mesa de forma equilibrada y armónica. La iluminación natural 
                            proviene de una ventana que se encuentra fuera del cuadro.</p>
                    </section>
                </article>
        </main>
        <footer>
            <a href="contacto.html">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
    </body>
</html>