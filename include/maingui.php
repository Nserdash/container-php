<?php
if($_GET['action'] == "exit") {

    $auth->Logout();
    header("Location: /login", true);    

}


if ($path[0]=='') {
    
    $main = new basegrid();
    $graf = new graf();
    $graf->connection = $connect->connectDB();
    
    
    if(isset($_SESSION['userid']))    {
        
        echo'
        <div id = "hello">
        <h2 class = "wow fadein">Добро пожаловать, '.$_SESSION['name'].'!</h2>';
        
        $nameofpage = 'Добро пожаловать, '.$_SESSION['name'];
        
        $gr = $graf->CountStatus();

        include 'layouts/head.php';
        include 'include/menu.php';
        
        echo '
        </div>
        
        <div id = "stats">
            <div id = "graf"></div><div id ="diagram"></div>
        </div>';
        
                
    }
}    

if ($path[0]=='Сводные данные') {
    
    session_start();
    $alldata = new basegrid();
    $alldata->connection = $connect->connectDB();

    
    if(isset($_SESSION['userid']) && $_SESSION['rules'] == "Все")    {
        
        include('include/containersearch.php');

        $alldata->fieldnames = ["stage","container_number","owner", "dateofarrive", "arrivalpoint", "givingpoint", "executor", "dateofload", "train_number", "carriage_number", "dateofsending", "dateofgiving", "daysofusing", "idarrival","status"];
        $alldata->table = "arrival";
        $alldata->columns = ["Статус","Н.&nbsp;контейнера","Собственник", "Дата&nbsp;прибытия", "П.&nbsp;выдачи", "П.&nbsp;назначения","Перевозчик", "Дата&nbsp;погрузки", "Н.&nbsp;поезда", "Н.&nbsp;вагона", "Дата&nbsp;отправки", "Дата&nbsp;выдачи","В&nbsp;использовании"];
        
        $alldata->query =     
        
        "
        select s1.* from
        ( select getstage(a.idarrival) as stage, a.idarrival, a.container_number, a.owner, DATE_FORMAT(a.dateofarrive, '%d.%m.%Y') as dateofarrive, a.arrivalpoint, a.givingpoint, l.executor, DATE_FORMAT(l.dateofload, '%d.%m.%Y') as dateofload, t.train_number, t.carriage_number, DATE_FORMAT(t.dateofsending, '%d.%m.%Y') as dateofsending, DATE_FORMAT(g.dateofgiving, '%d.%m.%Y') as dateofgiving, g.daysofusing 
        FROM arrival a
        left JOIN giving g ON a.idarrival= g.arrivalid
        left JOIN transportiration t ON a.idarrival = t.arrivalid
        left JOIN loading l ON a.idarrival = l.arrivalid 
        ".$date."".$container." ".$status;
        
        
        $alldata->MakeFormDelete = false;
        $alldata->AddButton = false;
        $alldata->functions = "";
        
        include('layouts/head.php');
        include('include/menu.php');
        include('layouts/footer.php');
        $alldata->MakeGrid();
    
    }
}

if ($path[0]=='Подходы') {
    
    session_start();
    $arrival = new basegrid();
    $arrival->connection = $connect->connectDB();
    
    if(isset($_SESSION['userid']) && ($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Подходы"))    {
        
        include('include/containersearch.php');
    
        $arrival->fieldnames = ["stage","container_number","owner","dateofarrive", "arrivalpoint", "givingpoint", "idarrival", "status"];
        $arrival->table = "arrival";
        $arrival->columns = ["Статус", "Номер&nbsp;контейнера", "Собственник", "Дата&nbsp;прибытия", "Точка&nbsp;прихода", "Точка&nbsp;сдачи", "Действие"];
        $arrival->query = "
        
            select s1.* from ( 
            select getstage(a.idarrival) as stage, a.idarrival, a.container_number, a.owner, DATE_FORMAT(a.dateofarrive, '%d.%m.%Y') as dateofarrive, a.arrivalpoint, a.givingpoint, a.status from arrival a
            ".$date."".$container."".$status." ORDER BY s1.".$columnorder." DESC";
            
        $arrival->MakeFormDelete = true;
        $arrival->AddButton = true;
        $arrival->functions = "";
        
         if($_GET['action'] == "insert") {
         
         $arrival->Insert();
         
         }
         
        if($_GET['action'] == "delete") {
        
            $arrival->Delete();
        
        }
        
        if($_GET['action'] == "edit") {
        
            $arrival->Edit();
        
        }
    
        include('layouts/head.php');
        include('include/menu.php');
        $arrival->MakeGrid();
        include('layouts/footer.php');
        
        
    }
}



if ($path[0]=='Автоперевозки') {

    session_start();
    $loading = new basegrid();
    $loading->connection = $connect->connectDB();
    $insertloading = new insertloading();
    $insertloading->connection = $connect->connectDB();
        
    if(isset($_SESSION['userid']) && ($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Автоперевозки"))    {
        
         include('include/containersearch.php');
        
        $loading->fieldnames = ["container_number","executor","customer", "train_number","loadingpoint", "dateofload","idloading","arrivalid"];
        $loading->table = "loading";
        $loading->columns = ["Номер&nbsp;контейнера", "Перевозчик", "Клиент","Номер&nbsp;поезда","Пункт погрузки", "Дата&nbsp;погрузки", "Действие"];
        $loading->query = "select getstage(l.arrivalid) as stage, l.idloading, l.executor, l.customer, l.train_number, l.loadingpoint, DATE_FORMAT(l.dateofload, '%d.%m.%Y') as dateofload, l.arrivalid, a.container_number from loading l inner join arrival a on (l.arrivalid = a.idarrival) ".$container."".$date." ORDER BY ".$columnorder." DESC";
        $loading->MakeFormDelete = true;
        $loading->AddButton = true;
        $loading->functions = "";
        
        //$loading->allowedit = ["Номер&nbsp;контейнера", "Перевозчик","Номер&nbsp;поезда", "Дата&nbsp;погрузки", "Действие"];
        //1) Имя поля
        //2) Заголовок
        //3) Тип поля
        //4) Разрешение редактирования (у всех инпутов есть атрибут disable)
        //5) Выравнивание
        //[
        //    ['container_number', "Номер&nbsp;контейнера","S",1,"L"],
        //    ['container_number', "Номер&nbsp;контейнера","S",1,"L"],
        //]
        // arr[j][0]  - имя поля таблицы
        // arr[j][1]  - заголовок
    
        if($_GET['action'] == "delete") {
        
            $loading->Delete();
        
        }
        
        if($_GET['action'] == "edit") {
        
            $loading->Edit();
        
        }
        
        if($_GET['action'] == "insertloading") {
        
            $insertloading->InsertL();
        
        }
    
        include('layouts/head.php');
        include('include/menu.php');
        $loading->MakeGrid();
        include('layouts/footer.php');
    
    }
}

if ($path[0]=='Формирование поезда') {

    session_start();
    $trainsformiration = new basegrid();
    $trainsformiration->connection = $connect->connectDB();
    $deletefromtr = new deletefromtr();
    $deletefromtr->connection = $connect->connectDB();

    
    if(isset($_SESSION['userid']) && ($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Поезда"))    {
        
        include('include/containersearch.php');
        
        $tn = $_GET['train_number'];
        
        $trainsformiration->fieldnames = ["container_number", "carriage_number", "dateofsending", "instruction", "sending_number","idtransportiration", "arrivalid"];
        $trainsformiration->table = "transportiration";
        $trainsformiration->columns = ["Номер&nbsp;контейнера", "Номер&nbsp;вагона","Дата&nbsp;отправки(д.м.г.)","Инструкция по сдаче", "Номер отправки","Действие"];
        $trainsformiration->query = "SELECT getstage(t.arrivalid) as stage, t.idtransportiration, DATE_FORMAT(t.dateofsending, '%d.%m.%Y') as dateofsending, t.carriage_number, t.sending_number, t.instruction, t.arrivalid, a.container_number from transportiration t inner join arrival a on (t.arrivalid = a.idarrival) where train_number = '".$tn."'".$container;
        $trainsformiration->MakeFormDelete = true;
        $trainsformiration->AddButton = false;
        $trainsformiration->functions = "";
        
        if($_GET['action'] == "edit") {
        
            $trainsformiration->Edit();
        
        }
        
        
        if($_GET['action'] == "deletefromtr") {
            
            $deletefromtr->TrDelete();
            
        }
    
        include('layouts/head.php');
        include('include/menu.php');
        $trainsformiration->MakeGrid();
        include('layouts/footer.php');
        
    }
}

if ($path[0]=='Поезда') {
    
    session_start();
    $trainslist = new trainslist();
    $trainslist->connection = $connect->connectDB();
    
    include('include/containersearch.php');
    
    if(isset($_SESSION['userid']) && ($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Поезда"))    {
        
        $trainslist->query = "SELECT distinct l.train_number from loading l where l.train_number IS NOT NULL and l.train_number != '' ";
        $trainslist->fieldnames = ["train_number"];
        $trainslist->columns = ["Номер&nbsp;поезда"];

        include('layouts/head.php');
        include('include/menu.php');
        $trainslist->Tlist();
        include('layouts/footer.php');

    }
}

if ($path[0]=='Пользование') {

    session_start();
    $using = new basegrid();
    $using->connection = $connect->connectDB();

    if(isset($_SESSION['userid']) && ($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Пользование"))    {
        
        include('include/containersearch.php');

        $using->fieldnames = ["container_number", "owner", "train_number", "dateofload", "dateofgiving", "daysofusing", "freedays","idgiving","arrivalid"];
        $using->table = "giving";
        $using->columns = [ "Номер&nbsp;контейнера",  "Собственник",  "Номер&nbsp;поезда", "Дата&nbsp;погрузки(д.м.г.)", "Дата&nbsp;cдачи", "Дней&nbsp;пользования", "Дней&nbsp;бесплатно", "Действие"];
        $using->query = "select getstage(g.arrivalid) as stage, g.idgiving, DATE_FORMAT(g.dateofgiving, '%d.%m.%Y') as dateofgiving, g.daysofusing , g.freedays, g.arrivalid, a.container_number, a.owner, l.train_number, DATE_FORMAT(l.dateofload, '%d.%m.%Y') as dateofload from giving g inner join arrival a on (g.arrivalid = a.idarrival) inner join loading l on (g.arrivalid = l.arrivalid) ".$container."".$date." ORDER BY ".$columnorder." DESC";
        $using->MakeFormDelete = 'middle';
        $using->AddButton = false;
        $using->functions = "";
        
        if($_GET['action'] == "edit") {
        
            $using->Edit();
        
        }
        
        include('layouts/head.php');
        include('include/menu.php');
        $using->MakeGrid();
        include('layouts/footer.php');
    
    }
}

if ($path[0]=='Ремонты') {

    session_start();
    $fixing = new basegrid();
    $fixing->connection = $connect->connectDB();

    if(isset($_SESSION['userid']) && ($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Ремонты"))    {
        
        include('include/containersearch.php');

        $fixing->fieldnames = ["container_number","train_number","problem", "value", "fixingdate","idfixing", "status"];
        $fixing->table = "fixing";
        $fixing->columns = ["Номер&nbsp;контейнера","Номер&nbsp;поезда", "Повреждение",  "Стоимость", "Дата", "Действие"];
        $fixing->query = "select idfixing, container_number, train_number, problem, value, DATE_FORMAT(fixingdate, '%d.%m.%Y') as fixingdate, status from fixing ".$container." ORDER BY ".$columnorder." DESC";
        $fixing->MakeFormDelete = true;
        $fixing->AddButton = true;
        $fixing->functions = "";
        
         if($_GET['action'] == "insert") {
         
         $fixing->Insert();
         
         }
         
        if($_GET['action'] == "delete") {
        
            $fixing->Delete();
        
        }
        
        if($_GET['action'] == "edit") {
        
            $fixing->Edit();
        
        }
        
        
        include('layouts/head.php');
        include('include/menu.php');
        $fixing->MakeGrid();
        include('layouts/footer.php');
        
    }
}

if ($path[0]=='Контрагенты') {

    session_start();
    $partners = new basegrid(); 
    $partners->connection = $connect->connectDB();

    if(isset($_SESSION['userid']) && $_SESSION['rules'] == "Все")    {
        
        include('include/containersearch.php');
        
        $partners->fieldnames = ["name", "contacts", "inn", "idpartners", ""];
        $partners->table = "partners";
        $partners->columns = ["Имя","Контакты","Инн", "Действие"];
        $partners->query = "select * from partners ".$contragent." ORDER BY ".$columnorder." DESC";
        $partners->MakeFormDelete = true;
        $partners->AddButton = true;
        $partners->functions = "";
        
         if($_GET['action'] == "insert") {
         
         $partners->Insert();
         
         }
         
        if($_GET['action'] == "delete") {
        
            $partners->Delete();
        
        }
        
        if($_GET['action'] == "edit") {
        
            $partners->Edit();
        
        }
    
    
    include('layouts/head.php');
    include('include/menu.php');
    $partners->MakeGrid();
    include('layouts/footer.php');
    
    }  else {
        
        header("Location:/");    

    }
}

if ($path[0]=='Пользователи') {

    session_start();
    $users = new basegrid(); 
    $users->connection = $connect->connectDB();

    if(isset($_SESSION['userid']) && $_SESSION['rules'] == "Все")    {
        
        include('include/containersearch.php');

        $users->fieldnames = ["login", "password", "name", "rules", "idusers", ""];
        $users->table = "users";
        $users->columns = ["Логин","Пароль","Имя", "Права", "Действие"];
        $users->query = "select * from users ".$contragent." ORDER BY idusers DESC";
        $users->MakeFormDelete = true;
        $users->AddButton = true;
        $users->functions = "";
        
         if($_GET['action'] == "insert") {
         
         $users->Insert();
         
         }
         
        if($_GET['action'] == "delete") {
        
            $users->Delete();
        
        }
        
        if($_GET['action'] == "edit") {
        
            $users->Edit();
        
        }
    
      
        include('layouts/head.php');
        include('include/menu.php');
        $users->MakeGrid();
        include('layouts/footer.php');
        
    }
}

?>