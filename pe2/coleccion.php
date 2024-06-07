<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Coleccion</title>
        <link rel="icon" type="image/png" href="imagenes/logo.png">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href="smallcoleccion.css" type="text/css" rel="stylesheet" media="(max-width: 1511px)">
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
            <h2>Colección</h2>
            <section class="coleccion">
                <aside>
                    <nav class="submenu">
                        <ul>
                            <li>
                                <a href="#" class="autores">Autores</a>
                                <ul>
                                    <?php
                                        require 'conexionbd.php'; // Archivo de conexión a la base de datos

                                        try {
                                            $sql_autores = "SELECT DISTINCT autor FROM Obras";
                                            $stmt_autores = $conexion->prepare($sql_autores);
                                            $stmt_autores->execute();
                                            $autores = $stmt_autores->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($autores as $autor) {
                                                echo '<li><a href="coleccion.php?autor=' . urlencode($autor['autor']) . '">' . htmlspecialchars($autor['autor']) . '</a></li>';
                                            }
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="tema">Tema</a>
                                <ul>
                                    <?php
                                        try {
                                            $sql_temas = "SELECT DISTINCT tema FROM Obras";
                                            $stmt_temas = $conexion->prepare($sql_temas);
                                            $stmt_temas->execute();
                                            $temas = $stmt_temas->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($temas as $tema) {
                                                echo '<li><a href="coleccion.php?tema=' . urlencode($tema['tema']) . '">' . htmlspecialchars($tema['tema']) . '</a></li>';
                                            }
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="epoca">Época</a>
                                <ul>
                                    <?php
                                        try {
                                            $sql_epocas = "SELECT DISTINCT epoca FROM Obras";
                                            $stmt_epocas = $conexion->prepare($sql_epocas);
                                            $stmt_epocas->execute();
                                            $epocas = $stmt_epocas->fetchAll(PDO::FETCH_ASSOC);


                                            foreach ($epocas as $epoca) {
                                                echo '<li><a href="coleccion.php?epoca=' . urlencode($epoca['epoca']) . '">' . htmlspecialchars($epoca['epoca']) . '</a></li>';
                                            }
                                            
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <?php
                        if (isset($_SESSION['usuario']) && $_SESSION['es_administrador'] == 1) {
                            echo '<a href="altaobra.php" id="addobra">Añadir obra</a>';
                        }
                    ?>
                </aside>
                <section class="colecciones">
                    <?php
                        require 'conexionbd.php'; 

                        // Obtener los parámetros de la URL
                        $epoca = isset($_GET['epoca']) ? $_GET['epoca'] : null;
                        $autor = isset($_GET['autor']) ? $_GET['autor'] : null;
                        $tema = isset($_GET['tema']) ? $_GET['tema'] : null;

                        // Definir el número de obras por página
                        $obras_por_pagina = 9;

                        // Obtener la página actual de la URL (si no está establecida, la página es 1)
                        $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

                        // Calcular el índice del primer obra en esta página
                        $primer_obra = ($pagina_actual - 1) * $obras_por_pagina;

                        try {
                            // Construir la consulta SQL según los parámetros
                            $sql = "SELECT * FROM Obras WHERE 1"; 
                            if ($epoca) {
                                $sql .= " AND epoca = :epoca";
                            }
                            if ($autor) {
                                $sql .= " AND autor = :autor";
                            }
                            if ($tema) {
                                $sql .= " AND tema = :tema";
                            }

                            // Modificar la consulta SQL para limitar el número de resultados
                            $sql .= " LIMIT :primer_obra, :obras_por_pagina";

                            $stmt = $conexion->prepare($sql);

                            // Asignar los valores a los placeholders (si los hay)
                            if ($epoca) {
                                $stmt->bindValue(':epoca', $epoca, PDO::PARAM_STR);
                            }
                            if ($autor) {
                                $stmt->bindValue(':autor', $autor, PDO::PARAM_STR);
                            }
                            if ($tema) {
                                $stmt->bindValue(':tema', $tema, PDO::PARAM_STR);
                            }

                            $stmt->bindValue(':primer_obra', $primer_obra, PDO::PARAM_INT);
                            $stmt->bindValue(':obras_por_pagina', $obras_por_pagina, PDO::PARAM_INT);

                            $stmt->execute();
                            $obras = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($obras as $obra) {
                                echo '<a href="obra.php?id=' . $obra['id'] . '"class="obrax">';
                                echo '<figure>';
                                echo '<img src="' . $obra['imagen'] . '" alt="Descripción de la imagen">';
                                echo '<figcaption>';
                                echo '<h4>' . htmlspecialchars($obra['titulo']) . '</h4>';
                                echo '<p>' . htmlspecialchars($obra['autor']) . '</p>';
                                echo '<p>' . htmlspecialchars($obra['epoca']) . '</p>';
                                echo '</figcaption>';
                                echo '</figure>';
                                echo '</a>';
                            }

                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </section>
            </section>
            <section id="paginacion">
                <?php
                    try {
                        // Calcular el número total de páginas considerando los filtros aplicados
                        $sql_total = "SELECT COUNT(*) as total FROM Obras WHERE 1";
                        if ($epoca) {
                            $sql_total .= " AND epoca = :epoca";
                        }
                        if ($autor) {
                            $sql_total .= " AND autor = :autor";
                        }
                        if ($tema) {
                            $sql_total .= " AND tema = :tema";
                        }

                        $stmt_total = $conexion->prepare($sql_total);

                        if ($epoca) {
                            $stmt_total->bindValue(':epoca', $epoca, PDO::PARAM_STR);
                        }
                        if ($autor) {
                            $stmt_total->bindValue(':autor', $autor, PDO::PARAM_STR);
                        }
                        if ($tema) {
                            $stmt_total->bindValue(':tema', $tema, PDO::PARAM_STR);
                        }

                        $stmt_total->execute();
                        $total_obras = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];
                        $total_paginas = ceil($total_obras / $obras_por_pagina);

                        // Mostrar los botones de paginación
                        if ($pagina_actual > 1) {
                            echo '<a href="coleccion.php?pagina=' . ($pagina_actual - 1);
                            if ($epoca) echo '&epoca=' . urlencode($epoca);
                            if ($autor) echo '&autor=' . urlencode($autor);
                            if ($tema) echo '&tema=' . urlencode($tema);
                            echo '" id="boton-anterior">Anterior</a>';
                        }
                        if ($pagina_actual < $total_paginas) {
                            echo '<a href="coleccion.php?pagina=' . ($pagina_actual + 1);
                            if ($epoca) echo '&epoca=' . urlencode($epoca);
                            if ($autor) echo '&autor=' . urlencode($autor);
                            if ($tema) echo '&tema=' . urlencode($tema);
                            echo '" id="boton-siguiente">Siguiente</a>';
                        }

                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conexion = null;
                ?>
            </section>
        </main>
        <section class="tooltip"></section> <script>
            var figures = document.querySelectorAll('figure');
            var tooltip = document.querySelector('.tooltip');

            for (var i = 0; i < figures.length; i++) {
                figures[i].addEventListener('mouseover', function(event) {
                     var titulo = this.querySelector('h4').textContent;
                     var categoria = this.querySelector('p').textContent;

                    tooltip.innerHTML = '<h3>' + titulo + '</h3><p>Categoría: ' + categoria + '</p>'; 
                    tooltip.style.display = 'block';

                    // Posiciona la tooltip a la derecha del cursor
                    tooltip.style.left = event.pageX + 10 + 'px';
                    tooltip.style.top = event.pageY + 10 + 'px'; 
                });

                figures[i].addEventListener('mouseout', function() {
                    tooltip.style.display = 'none';
                });
            }
        </script>
        <footer>
            <a href="contacto.php">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
    </body>
</html>
