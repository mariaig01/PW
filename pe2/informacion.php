<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Informacion</title>
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
            <section id="informacionhorarios">
                <h2>INFORMACIÓN GENERAL Y HORARIOS</h2>
                <article id="horarioEinformacion">
                    <table >
                        <tbody>
                            <tr>
                                <td>Lunes-sábado:</td>
                                <td>10-20 h</td>
                            </tr>
                            <tr>
                                <td>Domingos y festivos:</td>
                                <td>10-19 h</td>
                            </tr>
                            <tr>
                                <td>Cerrado:</td>
                                <td>1 enero, 1 mayo, 25 diciembre</td>
                            </tr>
                            <tr>
                                <td>Horario reducido:</td>
                                <td>10 - 14 h (6 enero, 24 y 31 diciembre)</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>La entrada del Museo incluye la visita a la Colección y a las exposiciones temporales.
                        El acceso se realiza con pase horario, seleccione fecha y hora al adquirir su entrada.
                        Las entradas gratuitas y reducidas requieren acreditación con el documento oficial correspondiente, válido 
                        y actualizado, en taquilla el día de la visita.</p>
                </article>
            </section>
            
            
            <section id="calendarioseccion" >
                <h2>CALENDARIO</h2>
                
                <article id="calendario">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="7"> Abril </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>L</td>
                                <td>M</td>
                                <td>X</td>
                                <td>J</td>
                                <td>V</td>
                                <td>S</td>
                                <td>D</td>
                            </tr>
                            <tr>
                                <td>01</td>
                                <td>02</td>
                                <td>03</td>
                                <td>04</td>
                                <td>05</td>
                                <td class="diamañana">06</td>
                                <td class="diamañana">07</td>
                            </tr>
                            <tr>
                                <td>08</td>
                                <td>09</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td class="diacompleto">19</td>
                                <td>20</td>
                                <td>21</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td class="diacerrado">23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                            </tr>
                            <tr>
                                <td>29</td>
                                <td>30</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th colspan="7"> Mayo </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>L</td>
                                <td>M</td>
                                <td>X</td>
                                <td>J</td>
                                <td>V</td>
                                <td>S</td>
                                <td>D</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="diacerrado">01</td>
                                <td>02</td>
                                <td class="diacompleto">03</td>
                                <td>04</td>
                                <td>05</td>
                            </tr>
                            <tr>
                                <td>06</td>
                                <td>07</td>
                                <td>08</td>
                                <td>09</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>21</td>
                                <td class="diacompleto">22</td>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                                <td>30</td>
                                <td>31</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th colspan="7"> Junio </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>L</td>
                                <td>M</td>
                                <td>X</td>
                                <td>J</td>
                                <td>V</td>
                                <td>S</td>
                                <td>D</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>01</td>
                                <td class="diacerrado">02</td>
                            </tr>
                            <tr>
                                <td>03</td>
                                <td>04</td>
                                <td>05</td>
                                <td>06</td>
                                <td>07</td>
                                <td>08</td>
                                <td>09</td>
                            </tr>
                            <tr>
                                <td class="diamañana">10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td class="diacompleto">18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                                <td class="diamañana">30</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    
                </article>
                <article id="leyenda">
                    <table>
                        <tr>
                            <td>Apertura completa:</td>
                            <td id="verde"></td>
                        </tr>
                        <tr>
                            <td>Apertura de mañana:</td>
                            <td id="amarillo"></td>
                        </tr>
                        <tr>
                            <td>Cerrado:</td>
                            <td id="rojo"></td>
                        </tr>
                    </table>
                </article>
            </section>
            <section id="precios">
                <h2>PRECIOS DE LAS ENTRADAS</h2>
                    <section>
                        <article>
                            <h3>ENTRADA GENERAL</h3>
                            <p>15€</p>
                        </article>
                        <article>
                            <h3>ENTRADA REDUCIDA</h3>
                            <p>10€</p>
                            <ul>
                                <li>Personas mayores de 65 años</li>
                                <li>Titulares del carné joven</li>
                                <li>Miembros de familias numerosas</li>
                            </ul>
                        </article>
                        <article>
                            <h3>ENTRADA GRATUITA</h3>
                            <ul>
                                <li>Menores de 18 años</li>
                                <li>Estudiantes entre 18 y 25 años</li>
                                <li>Estudiantes mayores de 25 años de grado y posgrado en rama de arte (Sistema Educativo Español)</li>
                                <li>Personas con discapacidad igual o superior al 33%</li>
                                <li>Personas en situación legal de desempleo</li>
                                <li>Personal docente en activo</li>
                            </ul>
                        </article>
                    </section>
            </section>
        </main>
        <footer>
            <a href="contacto.html">Contacto</a>
            <a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
        </footer>
    </body>
</html>