<?php 
     // Datos de conexión a la base de datos
     $dsn = "mysql:host=localhost;dbname=dbangustias16_pw2324";
     $usuario = "pwangustias16";
     $password = "23angustias1624";

     $conexion = new PDO($dsn, $usuario, $password);
     $conexion->exec("SET NAMES utf8mb4"); 
     $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>