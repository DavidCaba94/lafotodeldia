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
$url = (isset($_POST['url'])) ? $_POST['url'] : '';
$likes = (isset($_POST['likes'])) ? $_POST['likes'] : '';
$date = (isset($_POST['date'])) ? $_POST['date'] : '';
$date_ini = (isset($_POST['date_ini'])) ? $_POST['date_ini'] : '';
$date_fin = (isset($_POST['date_fin'])) ? $_POST['date_fin'] : '';

switch($opcion){
	case 1:
            $consulta = "SELECT * FROM images ORDER BY id DESC";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 2:
            $consulta = "INSERT INTO images (id_user, url, likes, date) VALUES('$id_user', '$url', '$likes', '$date') ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                
            break;
      case 3:
            $consulta = "SELECT * FROM images WHERE id_user = '$id_user' ORDER BY id DESC";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 4:
            $consulta = "SELECT * FROM images WHERE id_user = '$id_user' ORDER BY id DESC LIMIT 9";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 5:
            $consulta = "SELECT
                        U.user as 'user',
                        U.foto as 'foto',
                        I.id as 'id',
                        I.id_user as 'id_user',
                        I.url as 'url',
                        I.likes as 'likes',
                        I.date as 'date'
                        FROM images I
                        JOIN users U
                        ON I.id_user = U.id
                        WHERE I.date = '$date'
                        ORDER BY I.likes DESC";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 6:
            $consulta = "SELECT
                        U.user as 'user',
                        U.foto as 'foto',
                        I.id as 'id',
                        I.id_user as 'id_user',
                        I.url as 'url',
                        I.likes as 'likes',
                        I.date as 'date'
                        FROM images I
                        JOIN users U
                        ON I.id_user = U.id
                        WHERE I.date BETWEEN '$date_ini' AND '$date_fin'
                        ORDER BY I.likes DESC";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 7:
            $consulta = "DELETE FROM images WHERE id='$id' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                           
            break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;