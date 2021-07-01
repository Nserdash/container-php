<?php

$filter = 'Вeсь список за прошедшие 30 дней';

$container = '';

$stage = '';

$todate = date("d.m.Y", strtotime($thisDate. " - 30 day"));

$date = date("d.m.Y");

if($path[0]=='Подходы' || $path[0]=='Сводные данные') {
$date = " where (dateofarrive >= STR_TO_DATE('".$todate."', '%d.%m.%Y') and dateofarrive <= STR_TO_DATE('".$date."', '%d.%m.%Y')) or dateofarrive is NULL) as s1";
} else {
$date = " where ((dateofarrive >= STR_TO_DATE('".$todate."', '%d.%m.%Y') and dateofarrive <= STR_TO_DATE('".$date."', '%d.%m.%Y')) or dateofarrive is NULL)";    
}


if(isset($_POST['container']) && ($_POST['container']!= "" || NULL) ) {

$container = " where container_number = '".$_POST['container']."'";

}


if($path[0]=='Формирование поезда') {

    $container = '';
    
    if(isset($_POST['container']) && ($_POST['container']!= "" || NULL) ) {
    
    $container = " and container_number = '".$_POST['container']."'";
    
    }

}


if($path[0]=='Сводные данные') {

    $container = '';
    
    if(isset($_POST['container']) && ($_POST['container']!= "" || NULL) ) {
    
    $container = "  where s1.container_number  = '".$_POST['container']."'";
    
    }

}


if($_POST['container'] == 'Все контейнеры') {

$container = '';

}


if($path[0]=='Подходы' || $path[0]=='Сводные данные') {
    
    
    
    if($container == '') {

        if(isset($_POST['status']) && $_POST['status'] != 1) {
        
        $status = " where s1.stage = '".$_POST['status']."'";
        
        
        } else {
        
          $status = '';    
          
        }

    } else {
        
        if(isset($_POST['status']) && $_POST['status'] != 1) {
        
        $status = " and s1.stage = '".$_POST['status']."'";
        
        } else {
        
          $status = '';    
        
        }
        
    }
    
}

if(isset($_POST['calenfrom']) && ($_POST['calento']!= "" || NULL) ) {
    
    if($container == '' && $status == '') {
    
    if($path[0]=='Подходы' || $path[0]=='Сводные данные') {
    $date = " where dateofarrive >= STR_TO_DATE('".$_POST['calenfrom']."', '%d.%m.%Y') and dateofarrive <= STR_TO_DATE('".$_POST['calento']."', '%d.%m.%Y')) as s1";
    } else {
    $date = " where dateofarrive >= STR_TO_DATE('".$_POST['calenfrom']."', '%d.%m.%Y') and dateofarrive <= STR_TO_DATE('".$_POST['calento']."', '%d.%m.%Y')";        
    }
    $filter = $_POST['container'].', период: С ' .$_POST['calenfrom'].' По ' .$_POST['calento'];
    
    } else {
        
        if($path[0]=='Подходы' || $path[0]=='Сводные данные') {
        $date = " where dateofarrive >= STR_TO_DATE('".$_POST['calenfrom']."', '%d.%m.%Y') and dateofarrive <= STR_TO_DATE('".$_POST['calento']."', '%d.%m.%Y')) as s1";
        } else {
        $date = " and dateofarrive >= STR_TO_DATE('".$_POST['calenfrom']."', '%d.%m.%Y') and dateofarrive <= STR_TO_DATE('".$_POST['calento']."', '%d.%m.%Y')";            
        }
        $filter = $_POST['container'].', период: С ' .$_POST['calenfrom'].' По ' .$_POST['calento'];
        
            
        if(isset($_POST['status']) && $_POST['status'] != 1) {
        
        $filter = $_POST['container'].' в период с ' .$_POST['calenfrom'].' по ' .$_POST['calento'].' со статусом: ' .$_POST['status'];    
            
        }
        
    }
    

}

$contragent = '';

if(isset($_POST['contragent']) && ($_POST['contragent']!= "" || NULL) && (!isset($_POST['inn']) || $_POST['inn'] == "") ) {

    $contragent = "where name = '".$_POST['contragent']."'";
    
    $filter = "Контрагенты с именем ".$_POST['contragent'];

}

if(isset($_POST['inn']) && ($_POST['inn']!= "" || NULL) && (!isset($_POST['contragent']) || $_POST['contragent'] == "") ) {

    $contragent = "where inn = '".$_POST['inn']."'";
    
    $filter = "Контрагенты с ИНН ".$_POST['inn'];

}

if(isset($_POST['inn']) && ($_POST['inn']!= "" || NULL) && isset($_POST['contragent']) && ($_POST['contragent']!= "" || NULL) ) {

    $contragent = "where inn = '".$_POST['inn']."' and name = '".$_POST['contragent']."'";
    
    $filter = "Контрагенты с ИНН ".$_POST['inn']." и именем ".$_POST['contragent'] ;

}

if($path[0]=='Сводные данные' || $path[0]=='Подходы' ) {
$columnorder = "idarrival";    
} else {
$columnorder = "arrivalid";        
}

if(isset($_GET['columnorder'])) {
$columnorder = $_GET["columnorder"];        
$filter = "Отсортировано по полю <b>".mb_strtolower($_GET["columname"], 'UTF-8')."</b>";
}


?>