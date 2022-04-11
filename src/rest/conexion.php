<?php
    class Conexion{
        public static function Conectar(){
            define('servidor', '75.102.57.98');
            define('nombre_bd', 'pbugvnid_lafotodeldia');
            define('usuario', 'pbugvnid_admin');
            define('password', '3Yrm^G~B}n*B');	
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
            try{
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
                return $conexion;                    
            }catch (Exception $e){
                die("El error de Conexión es: ". $e->getMessage());
            }
        }
    }
?>