<?php
define('DB_HOST','localhost');
define('DB_USER','host1744844_nikita');
define('DB_PASSWORD','123123');
define('DB_NAME','host1744844_nikita');
include('classes/basegridclass.php');
include('classes/authorization.php');
include('classes/graf.php');
include('classes/connection.php');
include('classes/deletefromtr.php');
include('classes/insertloading.php');
include('classes/trainslist.php');
ini_set('session.gc_maxlifetime', 604800);
ini_set('session.cookie_lifetime', 604800);

session_start();
$path = explode('/', $_GET["path"]);

$connect = new connection();
$auth = new authorization();
$auth->connection = $connect->connectDB();

if (!$auth->CheckLogin()) {

    if ($path[0] == 'login') {

        $nameofpage = 'Авторизация';
        
        include 'layouts/head.php';
        include 'include/loginform.php';
        include('layouts/footer.php');
        return;
        
    } else {
       
       header("Location: /login", true);    
       return;
       
    }

} else {

    $nameofpage = $path[0];
    include 'include/maingui.php';

}


?>