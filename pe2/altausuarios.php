<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
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

                // Validar si el formulario está totalmente vacío
                const camposVacios = ['nombreusuario', 'contrasenia', 'nombre', 'apellidos', 'correo', 'telefono', 'fecha', 'comunidadautonoma', 'provincia', 'imagen'];
                if (camposVacios.some(campo => !document.getElementById(campo).value.trim())) { 
                    alert('Todos los campos son obligatorios.');
                    return;
                }

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
                if (!nombreusuario || !contrasenia || !nombre || !apellidos || !correo || !telefono || !fecha || !comunidadautonoma || !provincia || !aceptar_terminos) {
                    alert('Todos los campos son obligatorios.');
                    return;
                }

                // Validar el formato del correo electrónico
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(correo)) {
                    alert('Por favor, introduce un correo electrónico válido.');
                    return;
                }

                // Validar el formato de la fecha
                const fechaRegex = /^\d{2}-\d{2}-\d{4}$/;
                if (!fechaRegex.test(fecha)) {
                    alert('Por favor, introduce una fecha válida en el formato DD-MM-AAAA.');
                    return;
                }

                // Validar el formato del teléfono
                const telefonoRegex = /^\d{9}$/;
                if (!telefonoRegex.test(telefono)) {
                    alert('Por favor, introduce un número de teléfono válido de 9 dígitos.');
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

                // Validar que el teléfono no esté repetido
                const existeTelefono = await verificarExistencia('telefono', telefono);
                if (existeTelefono) {
                    alert('El número de teléfono ya está registrado.');
                    return;
                }

                // Validar que el usuario ha seleccionado una opción de visita al Prado
                if (!document.querySelector('input[name="visita_prado"]:checked')) {
                    alert('Por favor, selecciona si has visitado el Museo del Prado.');
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

            async function verificarNombreUsuario() {
                const nombreusuario = document.getElementById('nombreusuario').value;
                const mensajeUsuario = document.getElementById('mensaje-usuario');

                // Verificar el nombre de usuario solo si hay algo escrito
                if (nombreusuario.trim() !== '') {
                    // Enviar solicitud al servidor para verificar la disponibilidad del nombre de usuario
                    const response = await fetch(`verificarusuario.php?nombreusuario=${nombreusuario}`);
                    const data = await response.json();

                    // Mostrar mensaje según la disponibilidad del nombre de usuario
                    if (data.disponible) {
                        mensajeUsuario.textContent = 'Nombre de usuario disponible.';
                        mensajeUsuario.style.color = 'green';
                    } else {
                        mensajeUsuario.textContent = '¡El nombre de usuario ya está en uso!';
                        mensajeUsuario.style.color = 'red';
                    }
                } else {
                    // Limpiar mensaje si el campo está vacío
                    mensajeUsuario.textContent = '';
                }
            }
        </script>
    </head>
    <body>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $nombreusuario = $_POST['nombreusuario'];
            $contrasenia = $_POST['contrasenia'];
            $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT); // Crear un hash de la contraseña
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
            $imagen = $_POST['imagen'];

            $fecha_nacimiento = date("Y-m-d", strtotime(str_replace('/', '-', $fecha_nacimiento)));

            try {
                // Conexión a la base de datos
                require 'conexionbd.php';

                // Consulta SQL para insertar el nuevo usuario
                $sql = "INSERT INTO Usuarios (nombreusuario, contrasenia, nombre, apellidos, correo, telefono, fecha_nacimiento, comunidad_autonoma, provincia, visita_prado, aceptar_terminos, es_administrador, imagen)
                        VALUES (:nombreusuario, :contrasenia, :nombre, :apellidos, :correo, :telefono, :fecha_nacimiento, :comunidad_autonoma, :provincia, :visita_prado, :aceptar_terminos, :es_administrador, :imagen)";

                // Preparar la consulta
                $stmt = $conexion->prepare($sql);
                // Enlazar los parámetros
                $stmt->bindParam(':nombreusuario', $nombreusuario);
                $stmt->bindParam(':contrasenia', $hashed_password);
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
                $stmt->bindParam(':imagen', $imagen);

                // Ejecutar la consulta
                $stmt->execute();

                // Iniciar sesión automáticamente después de registrar al usuario
                echo '<form id="loginForm" action="iniciosesion.php" method="post" style="display: none;">
                <input type="hidden" name="usuario" value="' . $nombreusuario . '">
                <input type="hidden" name="contraseña" value="' . $contrasenia . '">
                <input type="hidden" name="registro" value="true">
                </form>
                <script type="text/javascript">
                    document.getElementById("loginForm").submit();
                </script>';
                exit();

                //header("Location: altaexitosa.php");
            } catch (PDOException $e) {
                // Manejo de errores
                echo "Error: " . $e->getMessage();
            }
        }
        ?>
        <header>
            <section>
                <img class="logo" src="imagenes/logo.png" alt="Logo del museo">
                <h1 class="nombre">Museo ArteVivo</h1>
                <?php include 'formularioinicio.php' ?>
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
                <form id="formularioregistro" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" require onsubmit="validarFormulario(event)">
                    <label for="nombreusuario">Nombre de usuario:</label>
                    <input type="text" name="nombreusuario" id="nombreusuario" oninput="verificarNombreUsuario()">
                    <p id="mensaje-usuario"></p>

                    <label for="contrasenia">Contraseña:</label>
                    <input type="password" name="contrasenia" id="contrasenia">

                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre">

                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos">

                    <label for="correo">Correo Electrónico:</label>
                    <input type="text" id="correo" name="correo">

                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono">

                    <label for="fecha">Fecha de nacimiento:</label>
                    <input type="text" id="fecha" name="fecha">

                    <label for="comunidadautonoma">Comunidad Autónoma</label>
                    <input list="opciones" id="comunidadautonoma" name="comunidadautonoma">
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

                    <label for="imagen">Imagen:</label>
                    <input type="text" id="imagen" name="imagen">

                    <label for="provincia">Provincia:</label>
                    <input type="text" id="provincia" name="provincia">

                    <section id="form-radio">
                        <p>¿Has visitado el Museo del Prado?</p>
                        <label>Sí </label><input type="radio" id="visita_prado_si" name="visita_prado" value="si">
                        <label>No</label><input type="radio" name="visita_prado" value="no">
                    </section>
                    <section id="aceptar-terminos">
                        <label for="aceptar_terminos">Aceptar términos y condiciones:</label>
                        <input type="checkbox" name="aceptar_terminos" id="aceptar_terminos">
                    </section>
                    <input type="submit" value="Registrarse" id="boton-registro">
                </form>
            </section>
            <footer>
                <a href="contacto.php">Contacto</a>
                <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
            </footer>
        </main>
    </body>
</html>