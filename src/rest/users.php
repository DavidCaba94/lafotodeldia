<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);

function permisos() {  
  if (isset($_SERVER['HTTP_ORIGIN'])){
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
      header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
      header('Access-Control-Allow-Credentials: true');      
  }  
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))          
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
    exit(0);
  }
}
permisos();


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$user = (isset($_POST['user'])) ? $_POST['user'] : '';
$pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$foto = (isset($_POST['foto'])) ? $_POST['foto'] : '';
$id_user = (isset($_POST['id_user'])) ? $_POST['id_user'] : '';
$id_following = (isset($_POST['id_following'])) ? $_POST['id_following'] : '';

$pass = md5($pass);

switch($opcion){
	case 1:
        $consulta = "SELECT * FROM users ORDER BY id DESC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "INSERT INTO users (user, pass, email, foto, verificado) VALUES('$user', '$pass', '$email', '$foto', 0) ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 3:
        $consulta = "SELECT user FROM users WHERE user = '$user' OR email = '$email'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4:
        $consulta = "SELECT * FROM users WHERE (user = '$user' OR email = '$email') AND pass = '$pass'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "UPDATE users SET foto='$foto' WHERE id='$id' ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 6:
        $consulta = "SELECT * FROM users WHERE id = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7:
        $consulta = "INSERT INTO followers (id_user, id_following) VALUES('$id_user', '$id_following') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 8:
        $consulta = "DELETE FROM followers WHERE id_user = '$id_user' AND id_following = '$id_following'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 9:
        $consulta = "SELECT * FROM followers WHERE id_user = '$id_user' AND id_following = '$id_following'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 10:
        $consulta = "UPDATE users SET pass='$pass' WHERE id='$id' ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 11:
        $consulta = "SELECT id, user, email, foto, verificado FROM users WHERE id = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 12:
        $consulta = "SELECT COUNT(*) as numPhotosOfDay 
                    FROM image_of_day 
                    WHERE id_image IN
                    (SELECT id FROM images
                    WHERE id_user = '$id')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 13:
        $consulta = "SELECT COUNT(*) as numPhotosOfMonth 
                    FROM image_of_month 
                    WHERE id_image IN
                    (SELECT id FROM images
                    WHERE id_user = '$id')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 14:
        $consulta = "SELECT COUNT(*) as numPhotosOfYear 
                    FROM image_of_year 
                    WHERE id_image IN
                    (SELECT id FROM images
                    WHERE id_user = '$id')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 15:
        $consulta = "UPDATE users SET verificado=1 WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;