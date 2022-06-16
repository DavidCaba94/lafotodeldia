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
$id_user = (isset($_POST['id_user'])) ? $_POST['id_user'] : '';
$id_following = (isset($_POST['id_following'])) ? $_POST['id_following'] : '';
$date = (isset($_POST['date'])) ? $_POST['date'] : '';

switch($opcion){
	  case 1:
        $consulta = "SELECT * FROM users ORDER BY id DESC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "SELECT COUNT(*) as numUsers FROM users";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "INSERT INTO followers (id_user, id_following) VALUES('$id_user', '$id_following') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 4:
        $consulta = "SELECT *
                    FROM users
                    WHERE id IN 
                    (SELECT id_following 
                    FROM followers 
                    WHERE id_user = '$id_user')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "SELECT COUNT(*) as numFollowedUsers FROM followers WHERE id_user = '$id_user'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6:
        $consulta = "SELECT *
                    FROM users
                    WHERE id IN 
                    (SELECT id_user 
                    FROM followers 
                    WHERE id_following = '$id_user')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7:
        $consulta = "SELECT COUNT(*) as numFollowersUsers FROM followers WHERE id_following = '$id_user'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 8:
        $consulta = "SELECT * FROM followers WHERE id_user = '$id_user' OR id_following = '$id_user'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 9:
        $consulta = "DELETE FROM followers WHERE id_user = '$id_user' AND id_following = '$id_following'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 10:
        $consulta = "SELECT
                    U.id as 'id_user',
                    U.user as 'user',
                    U.foto as 'foto',
                    U.verificado as 'verificado',
                    I.id as 'id',
                    I.id_user as 'id_user',
                    I.url as 'url',
                    I.likes as 'likes',
                    I.date as 'date'
                    FROM images I
                    JOIN users U
                    ON I.id_user = U.id
                    WHERE I.date = '$date'
                    ORDER BY I.likes DESC
                    LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 11:
        $consulta = "SELECT
                    U.id as 'id_user',
                    U.user as 'user',
                    U.foto as 'foto',
                    U.verificado as 'verificado',
                    I.id as 'id',
                    I.id_user as 'id_user',
                    I.url as 'url',
                    I.likes as 'likes',
                    I.date as 'date'
                    FROM images I
                    JOIN users U
                    ON I.id_user = U.id
                    WHERE I.id_user IN (
                        SELECT id_following 
                        FROM followers 
                        WHERE id_user = '$id_user'
                    ) OR I.id_user = '$id_user'
                    ORDER BY I.id DESC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;