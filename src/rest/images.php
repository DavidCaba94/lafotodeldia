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
$id_image = (isset($_POST['id_image'])) ? $_POST['id_image'] : '';

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
                        ORDER BY I.likes DESC
                        LIMIT 50";
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
                        ORDER BY I.likes DESC
                        LIMIT 50";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 7:
            $consulta = "DELETE FROM images WHERE id='$id' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                           
            break;
      case 8:
            $consulta = "SELECT * FROM images WHERE date='$date' ORDER BY id ASC";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 9:
            $consulta = "SELECT id_image FROM last_voted WHERE id_user='$id_user'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 10:
            $consulta = "INSERT INTO last_voted (id_user, id_image) VALUES('$id_user', 0) ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                
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
                        WHERE I.id > '$id_image' AND I.date='$date' 
                        ORDER BY I.id ASC 
                        LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 12:
            $consulta = "UPDATE last_voted SET id_image='$id_image' WHERE id_user='$id_user' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 13:
            $consulta = "UPDATE images SET likes = likes + 1 WHERE id='$id_image' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 14:
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
                        WHERE I.date BETWEEN '$date_ini' AND '$date_fin'
                        ORDER BY I.likes DESC
                        LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 15:
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
                        FROM image_of_day W
                        JOIN images I
                        ON W.id_image = I.id
                        JOIN users U
                        ON I.id_user = U.id
                        WHERE W.date BETWEEN '$date_ini' AND '$date_fin'
                        ORDER BY W.date ASC";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 16:
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
                        FROM image_of_day W
                        JOIN images I
                        ON W.id_image = I.id
                        JOIN users U
                        ON I.id_user = U.id
                        WHERE W.date='$date'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 17:
            $consulta = "SELECT * FROM images WHERE id='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 18:
            $consulta = "UPDATE image_of_day SET id_image='$id_image' WHERE date='$date'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 19:
            $consulta = "INSERT INTO image_of_day (id_image, date) VALUES('$id_image', '$date')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                
            break;
      case 20:
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
                        FROM image_of_month W
                        JOIN images I
                        ON W.id_image = I.id
                        JOIN users U
                        ON I.id_user = U.id
                        WHERE W.date BETWEEN '$date_ini' AND '$date_fin'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 21:
            $consulta = "UPDATE image_of_month SET id_image='$id_image', date='$date' WHERE date BETWEEN '$date_ini' AND '$date_fin'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 22:
            $consulta = "INSERT INTO image_of_month (id_image, date) VALUES('$id_image', '$date')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                
            break;
      case 23:
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
                        FROM image_of_year W
                        JOIN images I
                        ON W.id_image = I.id
                        JOIN users U
                        ON I.id_user = U.id
                        WHERE W.date BETWEEN '$date_ini' AND '$date_fin'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 24:
            $consulta = "UPDATE image_of_year SET id_image='$id_image', date='$date' WHERE date BETWEEN '$date_ini' AND '$date_fin'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 25:
            $consulta = "INSERT INTO image_of_year (id_image, date) VALUES('$id_image', '$date')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                
            break;
      case 26:
            $consulta = "SELECT * FROM images WHERE id IN 
                        (SELECT id_image FROM image_of_day)
                        AND id_user='$id_user'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 27:
            $consulta = "SELECT id FROM images WHERE id IN 
                        (SELECT id_image FROM image_of_month)
                        AND id_user='$id_user'";
                        $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
      case 28:
            $consulta = "SELECT id FROM images WHERE id IN 
                        (SELECT id_image FROM image_of_year)
                        AND id_user='$id_user'";
                        $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;