<?php
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

if (($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/gif")) {
    $randomName = rand();
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$randomName."-".$_FILES['file']['name'])) {
        //more code here...
        echo "https://davidcaballerocalvo.es/lafotodeldia/rest/images/".$randomName."-".$_FILES['file']['name'];
    } else {
        echo 0;
    }
} else {
    echo 1;
}
?>