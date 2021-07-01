<body>

    <div id = "search">

        <div class = "zoom">
                    
            <form action = "" method = "post" id = "srch">    

                
                
                <?php 
                if($this->table=="partners") {
                    
                    echo'<label>Наименование:</label><input name = "contragent" value = "" class = "calen"><br>';
                    echo'<label>ИНН:</label><input name = "inn" value = "" class = "calen"><br>';    
                    
                } else {
                    
                    echo '<label>Контейнер №:</label><input name = "container" value = "Все контейнеры" class = "calen"><br>';    
                
                    if($this->table == "arrival") {
        
                        echo'            
                        <label>Статус:</label>
                        <select class = "selectpc" name = "status">
                        <option value = "1">Любой</option>                    
                        <option>Ожидает прибытия</option>
                        <option>Прибыл</option>
                        <option>Погружен</option>
                        <option>Отправлен</option>
                        <option>Сдан в Китай</option>
                        </select><br>            
                        ';
                    }
                    
                    
                    
                    if($this->table<>"transportiration") {
                    
                    echo '
                    <div class = "calcline">
                        
                        <label>Период:&nbsp;</label>
                        с <input name = "calenfrom" class = "calen calenpicker" value = "'.date("d.m.Y", strtotime($thisDate. " - 30 day")).'">
                        по  <input name = "calento" class = "calen calenpicker" value = "'.date("d.m.Y").'"<br>
                        
                    </div>
                    ';
                    
                    }
                    
                }
                ?>


                <input type = "submit" value = "Искать">
                
            </form>

            <div class = "X" onclick = "hidepopup('#search')">x</div>

        </div>        

    </div>

    <div id = "addform">

        <div class ="zoom">        
        <div class = "X" onclick = "hidepopup('#addform')">x</div>
            <?php
            
                if($this->table==("arrival" || "fixing") && $this->table!= "loading") {
                    
                    echo'
                    <b>Добавьте прибывший контейнер:</b><br>
                    ';    
                    
                    $this->MakeForm();

                }                

                if($this->table=="loading") {

                    echo'
                    <b>Выберете прибывший контейнер из таблицы "Подходы":</b><br>
                    ';
            

                    $addform = $this->connection->query("SELECT container_number, idarrival, owner from arrival where status = '0' and getstage(idarrival) != 'Ожидает прибытия'");

                    if ($addform->num_rows > 0) {

                        while($row = $addform->fetch_assoc()) {

                        echo '
                        <br>
                        <table id = "insertzoomtable">

                        <form action = "?action=insertloading" method = "post" id="">

                            <tr id = "insert" class = "hover">

                                <td><input value = "'.$row['container_number'].'" name = "container_number"></td>
                                <td><input name = "executor" placeholder = "Перевозчик"></td>
                                <td><input name = "customer" placeholder = "Клиент" onclick = showpartners(this)></td>
                                <td><input name = "train_number" placeholder = "Номер поезда"></td>
                                <td><input name = "loadingpoint" placeholder = "Пункт погрузки"></td>
                                <td><input name = "dateofloading" placeholder = "Дата погрузки" class = "calenpicker"></td>
                                <td><input type = "submit" value = "Добавить" class = "addbtn"></td>
                                
                            </tr>

                                <td class = "invisible"><input value = "'.$row['idarrival'].'"name = "id"></td>
                                <td class = "invisible"><input value = "'.$row['owner'].'" name = "owner"></td>

                            
                        </form>

                        </table>
                        
                        ';

                        }

                    } else {

                    echo'Все прибывшие контейнеры уже добавлены!'; 
                    
                    }

                }
                

            ?>
            

        </div>

    </div>
    
    <div id = "partners">
    <div class = "X" onclick = "hidepopup('#partners')">x</div>            
    <?php        
    
     $addform = $this->connection->query("SELECT * from partners");

        if ($addform->num_rows > 0) {

            while($row = $addform->fetch_assoc()) {

            echo '
            <div style = "display:flex;flex-direction:row; justify-content:space-between;border-bottom:1px solid #ccc;margin:10px 0;">
            <div style = "display:flex;flex-direction:column;text-align:left;">
            '.$row['name'].'<br>
            <i style = "color:#888; font-size:0.8em;">'.$row['inn'].'</i>
            </div>
            <a href = "#" onclick = "setvalue(\''.$row['name'].'\')">Добавить</a>
            </div>';
            
            }
        }   
                
    ?>
    
    </div>        
    

    <div class = "myshadow wow fadein">

        <div class = "row" id = "top">

            <div class = "panel">

                <div class = "panel-instr">
                    
                    <input type = "image"  src = "/images/search.png" onclick = "showpopup('#search');" >
                    <input type = "image"  src = "/images/add.png" onclick = "showpopup('#addform');" <?php if($this->AddButton==false) { echo 'style = "display:none"';}?>>
                    
                </div>
                
            <div class = "titlerow">                

            <?php
                include('include/containersearch.php');
            
                if($this->table=="transportiration") {

                    $tn = $_GET['train_number'];

                    echo ' Поезд №: <u>'.$tn.'</u> <br>';
                    echo $filter;

                } else {
                    
                    echo $filter;
                    
                }

            ?>

            </div>
            
        </div>
            

    </div>


        
        <div class="scroll-table">
            
            <div class="uppertable">            
    
    	        <table>
    
                    <thead>
    
                        <tr>
    
                            <?php
    
                                for ($i = 0; $i < count($this->columns);  $i++) {
                                    
                                    if(isset($_GET['columname'])) {
                                        
                                        $columname = $_GET["columname"];
                                        
                                    }
                                    
                                    if($this->columns[$i] == $columname) {
                                        
                                        echo '<th class = "th"><a href = "?columnorder='.$this->fieldnames[$i].'&columname='.$this->columns[$i].'">'.$this->columns[$i].'▾</a></th>';
                                    
                                    } else {
                                    
                                      echo '<th class = "th"><a href = "?columnorder='.$this->fieldnames[$i].'&columname='.$this->columns[$i].'">'.$this->columns[$i].' - </a></th>';    
                                    
                                    }
                                        
                                }
    
                            ?>
    
                        </tr>
    
                    </thead>
    
    	        </table>	
    	        
    	   </div>

	    <div class="scroll-table-body" id = "maintable">

		<table>

			<tbody>
                <tr></tr>