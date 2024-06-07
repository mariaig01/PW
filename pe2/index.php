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
        <main id="indexmain">
            <section id="inf-index">
                <h2>¡Bienvenidos al Museo ArteVivo!</h2>
                <p>El Museo ArteVivo es un museo de arte contemporáneo que se encuentra en la ciudad de Granada. 
                    En él se exponen obras de arte de artistas españoles y extranjeros. El museo cuenta con una 
                    colección permanente y con exposiciones temporales. Además, ofrece visitas guiadas, talleres y conferencias. 
                    ¡Ven a visitarnos!</p>
            </section> 
        </main>
        <footer>
            <a href="contacto.php">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
    </body>
</html>
