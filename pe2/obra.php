<!doctype html>
<html lang="es">
    <head>
      <meta charset="utf-8">
      <title>Obra</title>
      <link rel="icon" type="image/png" href="imagenes/logo.png">
      <link rel="stylesheet" type="text/css" href="styles.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script>
        function confirmarEliminar(id) {
          if (confirm("¿Estás seguro de que deseas eliminar esta obra?")) {
            window.location.href = "eliminarobra.php?id=" + id;
          }
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
          require 'conexionbd.php';

          // Obtener el ID de la obra de la URL
          $id = isset($_GET['id']) ? $_GET['id'] : null;

          if ($id) {
            try {
              $sql = "SELECT * FROM Obras WHERE id = :id";
              $stmt = $conexion->prepare($sql);
              $stmt->bindValue(':id', $id, PDO::PARAM_INT);
              $stmt->execute();
              $obra = $stmt->fetch(PDO::FETCH_ASSOC);

              if ($obra) {
                // Mostrar la información de la obra
                echo '<figure>';
                echo '<img src="' . $obra['imagen'] . '" class="imagenobra" alt="Imagen de la obra">';
                echo '</figure>';
                echo '<section class="fichayobra">';
                echo '<article class="ficha-tecnica">';
                echo '<h3>' . htmlspecialchars($obra['titulo']) . '</h3>';
                echo '<p>' . htmlspecialchars($obra['autor']) . '</p>';
                echo '<p>' . htmlspecialchars($obra['tema']) . '</p>';
                echo '<p>' . htmlspecialchars($obra['epoca']) . '</p>';
                echo '<p>' . htmlspecialchars($obra['descripcion']) . '</p>';
                echo '</article>';
                echo '<aside class="obrasrelacionadas">';
                echo '<nav>';
                echo '<h3>Obras Relacionadas</h3>';
                echo '<ul>';

                // Obtener las obras relacionadas con el mismo tema
                $tema = $obra['tema'];
                $sql_relacionadas = "SELECT * FROM Obras WHERE tema = :tema AND id != :id";
                $stmt_relacionadas = $conexion->prepare($sql_relacionadas);
                $stmt_relacionadas->bindValue(':tema', $tema, PDO::PARAM_STR);
                $stmt_relacionadas->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt_relacionadas->execute();
                $obras_relacionadas = $stmt_relacionadas->fetchAll(PDO::FETCH_ASSOC);

                foreach ($obras_relacionadas as $obra_relacionada) {
                echo '<li><a href="obra.php?id=' . $obra_relacionada['id'] . '">' . htmlspecialchars($obra_relacionada['titulo']) . '</a></li>';
                }

                echo '</ul>';
                echo '</nav>';
                echo '</aside>';
                echo '</section>';
              } 
              else {
                echo '<p>No se encontró la obra.</p>';
              }
            } 
            catch (PDOException $e) {
              echo "Error: " . $e->getMessage();
            }
            $conexion = null;
          } 
          else {
            echo '<p>No se proporcionó el ID de la obra.</p>';
          }
          // Mostrar el botón de eliminar dentro del figure si el usuario es administrador
          if (isset($_SESSION['usuario']) && $_SESSION['es_administrador'] == 1) {
            echo '<a href="#" onclick="confirmarEliminar(' . $obra['id'] . ')" id="boton-eliminar-obra">Eliminar</a>';
            echo '<a href="editarobra.php?id=' . $obra['id'] . '" id="boton-editar-obra">Editar</a>';
          }
        ?>
      </main>
      <footer>
        <a href="contacto.php">Contacto</a>
        <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
      </footer>
    </body>
</html>