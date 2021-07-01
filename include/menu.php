<?php
$mystring = $_SERVER["REQUEST_URI"];
$findme   = 'trainformiration';
$pos = strpos($mystring, $findme);

$path = explode('/', $_GET["path"]);
?>


<div class = "container-fluid">
<nav class = "menu">
    
    <?php if($_SESSION['rules'] == "Все") {
        
        if ($path[0] == "Сводные данные") {
            
            echo '<a href="/Сводные данные" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.1s">';
            
        } else {
            
            echo'<a href="/Сводные данные" class="btn btn-primary wow fadein data-wow-delay= "0.1s">';
        
        }
            
            echo '<img src = "/images/alldata.png"> Сводные данные</a>';
    
    }
    
    if($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Подходы") {

        if ($path[0] == "Подходы") {
            
            echo '<a href="/Подходы" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.2s">';
            
        } else {
            
            echo'<a href="/Подходы" class="btn btn-primary wow fadein data-wow-delay= "0.2s">';
        
        }
            
            echo '<img src = "/images/arrive.png"> Подходы</a>';
        
    }
    
    if($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Автоперевозки") {
    
        if ($path[0] == "Автоперевозки") {
            
            echo '<a href="/Автоперевозки" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.3s">';
            
        } else {
            
            echo'<a href="/Автоперевозки" class="btn btn-primary wow fadein data-wow-delay= "0.3s">';
        
        }
            
            echo '<img src = "/images/truck.png"> Автоперевозки</a>';
    
    }
    
    if($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Поезда") {    
        
        if ($path[0] == "Поезда") {
            
            echo '<a href="/Поезда" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.4s">';
            
        } else {
            
            echo'<a href="/Поезда" class="btn btn-primary wow fadein data-wow-delay= "0.4s">';
        
        }
            
            echo '<img src = "/images/train.png"> Поезда</a>';
    
    }
    
    
    if($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Пользование") {    
        
        if ($path[0] == "Пользование") {
            
            echo '<a href="/Пользование" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.5s">';
            
        } else {
            
            echo'<a href="/Пользование" class="btn btn-primary wow fadein data-wow-delay= "0.5s">';
        
        }
            
            echo '<img src = "/images/time.png"> Пользование</a>';
    
    }

    if($_SESSION['rules'] == "Все" || $_SESSION['rules'] == "Ремонты") {    
        
        if ($path[0] == "Ремонты") {
            
            echo '<a href="/Ремонты" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.6s">';
            
        } else {
            
            echo'<a href="/Ремонты" class="btn btn-primary wow fadein data-wow-delay= "0.6s">';
        
        }
            
            echo '<img src = "/images/fix.png"> Ремонты</a>';
    
    }
    
    if($_SESSION['rules'] == "Все") {    
        
        if ($path[0] == "Контрагенты") {
            
            echo '<a href="/Контрагенты" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.7s">';
            
        } else {
            
            echo'<a href="/Контрагенты" class="btn btn-primary wow fadein data-wow-delay= "0.7s">';
        
        }
            
            echo '<img src = "/images/cooperation.png"> Контрагенты</a>';
    
    }
    
    if($_SESSION['rules'] == "Все") {    
        
        if ($path[0] == "Пользователи") {
            
            echo '<a href="/Пользователи" class="btn btn-primary btn-selected wow fadein data-wow-delay= "0.8s">';
            
        } else {
            
            echo'<a href="/Пользователи" class="btn btn-primary wow fadein data-wow-delay= "0.8s">';
        
        }
            
            echo '<img src = "/images/users.png"> Пользователи</a>';
    
    }
    
    
        
?>


</nav>

    <div class = "crush">
    <a href = "/">Главная</a>
    <a href = "?action=exit">Выйти</a>
    </div>


<select onchange="window.location.href = this.options[this.selectedIndex].value" class = "mobile select wow fadeinup" <?php if($path[0] == NULL) echo 'style = \'margin: 0 auto\'"'; ?>>
	<?php
	if($_SESSION['rules'] == "Все") {  if($path[0] == NULL) {echo '<option value="">Выберете таблицу▾</option>';}  else {echo'<option value="">'.$path[0].' ▾ </option>';} }
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Сводные данные") {echo '<option value="/Сводные данные" class = "btn-selected"> Сводные данные </option>';} else {echo'<option value="/Сводные данные"> Сводные данные </option>';}};
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Подходы") {echo '<option value="/Подходы" class = "btn-selected"> Подходы </option>';} else {echo'<option value="/Подходы"> Подходы </option>';}};
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Автоперевозки") {echo '<option value="/Автоперевозки" class = "btn-selected"> Автоперевозки </option>';} else {echo'<option value="/Автоперевозки"> Автоперевозки </option>';}};
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Поезда") {echo '<option value="/Поезда" class = "btn-selected"> Поезда </option>';} else {echo'<option value="/Поезда"> Поезда </option>';}};
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Пользование") {echo '<option value="/Пользование" class = "btn-selected"> Пользование </option>';} else {echo'<option value="/Пользование"> Пользование </option>';}};
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Ремонты") {echo '<option value="/Ремонты" class = "btn-selected"> Ремонты </option>';} else {echo'<option value="/Ремонты"> Ремонты </option>';}};
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Контрагенты") {echo '<option value="/Контрагенты" class = "btn-selected"> Контрагенты </option>';} else {echo'<option value="/Контрагенты"> Контрагенты </option>';}};
	if($_SESSION['rules'] == "Все") {  if ($path[0] == "Пользователи") {echo '<option value="/Пользователи" class = "btn-selected"> Пользователи </option>';} else {echo'<option value="/Пользователи"> Пользователи </option>';}};
	?>
</select>