<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Alta Usuarios</title>
        <link rel="icon" type="image/png" href="imagenes/logo.png">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script>
            async function validarFormulario(event) {
                event.preventDefault(); // Prevenir el envío del formulario

                // Obtener los valores de los campos
                const nombreusuario = document.getElementById('nombreusuario').value;
                const contrasenia = document.getElementById('contrasenia').value;
                const nombre = document.getElementById('nombre').value;
                const apellidos = document.getElementById('apellidos').value;
                const correo = document.getElementById('correo').value;
                const telefono = document.getElementById('telefono').value;
                const fecha = document.getElementById('fecha').value;
                const comunidadautonoma = document.getElementById('comunidadautonoma').value;
                const provincia = document.getElementById('provincia').value;
                const visita_prado = document.querySelector('input[name="visita_prado"]:checked').value;
                const aceptar_terminos = document.getElementById('aceptar_terminos').checked;

                // Validar que los campos no estén vacíos y otros criterios específicos
                if (!nombreusuario || !contrasenia || !nombre || !apellidos || !correo || !telefono || !fecha || !comunidadautonoma || !provincia || !visita_prado || !aceptar_terminos) {
                    alert('Todos los campos son obligatorios.');
                    return;
                }

                // Validar el formato del correo electrónico
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(correo)) {
                    alert('Por favor, introduce un correo electrónico válido.');
                    return;
                }

                // Validar el formato del teléfono
                const telefonoRegex = /^\d{9}$/;
                if (!telefonoRegex.test(telefono)) {
                    alert('Por favor, introduce un número de teléfono válido con 9 dígitos.');
                    return;
                }

                // Validar el formato de la fecha
                const fechaRegex = /^\d{4}-\d{2}-\d{2}$/;
                if (!fechaRegex.test(fecha)) {
                    alert('Por favor, introduce una fecha válida en el formato AAAA-MM-DD.');
                    return;
                }

                // Validar que el nombre de usuario no esté repetido
                const existeUsuario = await verificarExistencia('nombreusuario', nombreusuario);
                if (existeUsuario) {
                    alert('El nombre de usuario ya está registrado.');
                    return;
                }

                // Validar que el correo no esté repetido
                const existeCorreo = await verificarExistencia('correo', correo);
                if (existeCorreo) {
                    alert('El correo electrónico ya está registrado.');
                    return;
                }

                // Si todas las validaciones pasan, enviar el formulario
                document.getElementById('formularioregistro').submit();
            }

            async function verificarExistencia(campo, valor) {
                const response = await fetch(`verificarExistencia.php?campo=${campo}&valor=${valor}`);
                const data = await response.json();
                return data.existe;
            }
        </script>
    </head>
    <body>
    <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtener los datos del formulario
                    $nombreusuario = $_POST['nombreusuario'];
                    $contrasenia = $_POST['contrasenia'];
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $correo = $_POST['correo'];
                    $telefono = $_POST['telefono'];
                    $fecha_nacimiento = $_POST['fecha'];
                    $comunidad_autonoma = $_POST['comunidadautonoma'];
                    $provincia = $_POST['provincia'];
                    $visita_prado = $_POST['visita_prado'];
                    $aceptar_terminos = isset($_POST['aceptar_terminos']) ? 1 : 0;
                    $es_administrador = 0; // Por defecto, el usuario no es administrador

                    $fecha_nacimiento = date("Y-m-d", strtotime(str_replace('/', '-', $fecha_nacimiento)));

                    // Datos de conexión a la base de datos
                    $dsn = "mysql:host=localhost;dbname=dbangustias16_pw2324";
                    $usuario = "pwangustias16";
                    $password = "23angustias1624";

                    try {
                        // Conexión a la base de datos
                        $conexion = new PDO($dsn, $usuario, $password);
                        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Consulta SQL para insertar el nuevo usuario
                        $sql = "INSERT INTO Usuarios (nombreusuario, contrasenia, nombre, apellidos, correo, telefono, fecha_nacimiento, comunidad_autonoma, provincia, visita_prado, aceptar_terminos, es_administrador)
                                VALUES (:nombreusuario, :contrasenia, :nombre, :apellidos, :correo, :telefono, :fecha_nacimiento, :comunidad_autonoma, :provincia, :visita_prado, :aceptar_terminos, :es_administrador)";

                        // Preparar la consulta
                        $stmt = $conexion->prepare($sql);
                        // Enlazar los parámetros
                        $stmt->bindParam(':nombreusuario', $nombreusuario);
                        $stmt->bindParam(':contrasenia', $contrasenia);
                        $stmt->bindParam(':nombre', $nombre);
                        $stmt->bindParam(':apellidos', $apellidos);
                        $stmt->bindParam(':correo', $correo);
                        $stmt->bindParam(':telefono', $telefono);
                        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
                        $stmt->bindParam(':comunidad_autonoma', $comunidad_autonoma);
                        $stmt->bindParam(':provincia', $provincia);
                        $stmt->bindParam(':visita_prado', $visita_prado);
                        $stmt->bindParam(':aceptar_terminos', $aceptar_terminos);
                        $stmt->bindParam(':es_administrador', $es_administrador);

                        // Ejecutar la consulta
                        $stmt->execute();

                        header("Location: altaexitosa.php");
                    } 
                    catch (PDOException $e) {
                         // Manejo de errores
                         echo "Error: " . $e->getMessage();
                    }
                }
                ?>
        <header>
            <section>
                <img class="logo" src="imagenes/logo.png" alt="Logo del museo">
                <h1 class="nombre">Museo ArteVivo</h1>
                <form class="formulariousuario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" required>
                
                    <label for="contrasenia">contrasenia:</label>
                    <input type="password" name="contrasenia" id="contrasenia" required>
                    
                    <input type="submit" value="Iniciar sesión" class="iniciosesion">
                    <p>¿No dispones de cuenta?</p>
                    <a href="altausuarios.php">Regístrate</a>
                </form>
            </section>
            <nav class="menu">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="coleccion.php">Colección</a></li>
                    <li><a href="visita.php">Visita</a></li>
                    <li><a href="exposiciones.php">Exposiciones</a></li>
                    <li><a href="informacion.php">Información general</a></li>
                    <li><a href="experiencias.php">Experiencias</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section id="registro">
                <h2>Regístrate</h2>
                <form id="formularioregistro" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <label for="nombreusuario">Nombre de usuario:</label>
                    <input type="text" name="nombreusuario" id="nombreusuario" required>


                    <label for="contrasenia">Contraseña:</label>
                    <input type="password" name="contrasenia" id="contrasenia" required>


                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" required>
                
                    <label for="correo">Correo Electrónico:</label>
                    <input type="text" id="correo" name="correo" required>
                
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required>
                
                    <label for="fecha">Fecha de nacimiento:</label>
                    <input type="text" id="fecha" name="fecha" required>
                
                    <label for="comunidadautonoma">Comunidad Autónoma</label>
                    <input list="opciones" id="comunidadautonoma" name="comunidadautonoma" required>
                    <datalist id="opciones">
                        <option value="Andalucía">Andalucía</option>
                        <option value="Aragón">Aragón</option>
                        <option value="Asturias">Asturias</option>
                        <option value="Baleares">Baleares</option>
                        <option value="Canarias">Canarias</option>
                        <option value="Cantabria">Cantabria</option>
                        <option value="Castilla-La Mancha">Castilla-La Mancha</option>
                        <option value="Castilla y León">Castilla y León</option>
                        <option value="Cataluña">Cataluña</option>
                        <option value="Extremadura">Extremadura</option>
                        <option value="Galicia">Galicia</option>
                        <option value="La Rioja">La Rioja</option>
                        <option value="Madrid">Madrid</option>
                        <option value="Murcia">Murcia</option>
                        <option value="Navarra">Navarra</option>
                        <option value="País Vasco">País Vasco</option>
                        <option value="Valencia">Valencia</option>
                        <option value="Ceuta">Ceuta</option>
                        <option value="Melilla">Melilla</option>
                    </datalist>
                
                    <label for="provincia">Provincia:</label>
                    <input type="text" id="provincia" name="provincia" required>
                    
                    <section id="form-radio">
                        <p>¿Has visitado el Museo del Prado?</p>
                        <label>Sí </label><input type="radio" name="visita_prado" value="si" required>
                        <label>No</label><input type="radio" name="visita_prado" value="no" required> 
                    </section>
                    <section id="aceptar-terminos">
                        <label for="aceptar_terminos">Aceptar términos y condiciones:</label>
                        <input type="checkbox" name="aceptar_terminos" id="aceptar_terminos" required>
                    </section>
                    <input type="submit" value="Registrarse" id="boton-registro">
                </form>
            
              
            </section>
            <footer>
                <a href="contacto.html">Contacto</a>
                <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
            </footer>
        </main>
    </body>
</html>
