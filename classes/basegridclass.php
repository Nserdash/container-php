<?php

class basegrid {

    public $connection;
    public $fieldnames;
    public $table;
    public $columns;
    public $query;
    public $functions;
    public $MakeFormDelete;
    public $AddButton;
    public $MakeGraf;
    public $OnCellDraw;
    
    function CellDraw($i, $row) {
        
        echo '<td class = "tablerow">
        
        <div class = "mobileth mobile">
        
            <t>'.$this->columns[$i].'</t>
            
        </div>';
        
        if (isset($this->OnCellDraw)) {
          $this->OnCellDraw->SomeAction();
        }
    
        if($row[$this->fieldnames[$i]] == "Ожидает прибытия") {echo '<input style = "color:#f00 !important; font-weight:bold;" value = "'.$row[$this->fieldnames[$i]].'" disabled>';}
        else if($row[$this->fieldnames[$i]] == "Прибыл") {echo '<input style = "color:#FFAA00 !important; font-weight:bold;" value = "'.$row[$this->fieldnames[$i]].'" disabled>';}
        else if($row[$this->fieldnames[$i]] == "Погружен") {echo '<input style = "color:#0000CD !important; font-weight:bold;" value = "'.$row[$this->fieldnames[$i]].'" disabled>';}
        else if($row[$this->fieldnames[$i]] == "Отправлен") {echo '<input style = "color:#008000 !important; font-weight:bold;" value = "'.$row[$this->fieldnames[$i]].'" disabled>';}
        else if($row[$this->fieldnames[$i]] == "Сдан в Китай") {echo '<input style = "color:#888 !important; font-weight:bold;" value = "'.$row[$this->fieldnames[$i]].'" disabled>';}  
        
        else {
        
        $mystring = $this->fieldnames[$i];
        $findme   = 'date';
        $pos = strpos($mystring, $findme);
        
        
            if($pos===false) {    
            
                if($this->fieldnames[$i] == "customer") {
                
                    echo '<input name = "'.$this->fieldnames[$i].'" value = "'.$row[$this->fieldnames[$i]].'" onclick = showpartners(this) disabled>';
                    
                } else {
                    
                    echo '<input name = "'.$this->fieldnames[$i].'" value = "'.$row[$this->fieldnames[$i]].'" disabled>';                        
                    
                }                        

            } else {
                
              echo '<input name = "'.$this->fieldnames[$i].'" value = "'.$row[$this->fieldnames[$i]].'" class = "calenpicker" disabled>';      
            } 
            
            
        }
        
        
        echo '</td>';        
        
    }

    function MakeGrid () {

    $result = $this->connection->query($this->query);

    include 'include/tableheader.php';

    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {

             if($row['stage'] == "Сдан в Китай") echo '<tr class = "hover done">';
        
             else echo '<tr class = "hover">';
             
             echo '<form action = "?action=edit" method = "post" name="editrow">';
            
            for ($i = 0; $i < count($this->fieldnames)-2;  $i++) {
                
                $this->CellDraw($i, $row);

            }

            //Редактирование
            
            if($this->MakeFormDelete == true || $this->MakeFormDelete == 'middle') {
            
            echo '
            <td class = "invisible">
            <input name = "idtable" value = "'.$row[$this->fieldnames[count($this->fieldnames)-2]].'">
            <input name = "table" value = "'.$this->table.'">
            <input name = "arrivalid" value = "'.$row[$this->fieldnames[count($this->fieldnames)-1]].'">
            <input name = "idname" value = "'.$this->fieldnames[count($this->fieldnames)-2].'">
            </td>

            ';
            
            if($row['status'] == 1 || ($row['stage'] == "Отправлен" && $this->table != "giving") || $row['stage'] == "Сдан в Китай") echo '<td class = "action"><input type = "submit" value = "Изменить"  class = "fadeout" id = "edit" disabled></form>';
            else if($this->table == "arrival") echo '<td class = "action"><input type = "submit" value = "Изменить"  class = "fadeout" id = "edit" onclick = "return editform(this,1)"></form>';
            else if($this->table == "loading") echo '<td class = "action"><input type = "submit" value = "Изменить"  class = "fadeout" id = "edit" onclick = "return editform(this,2)"></form>';
            else if($this->table == "giving") echo '<td class = "action"><input type = "submit" value = "Изменить"  class = "fadeout" id = "edit" onclick = "return editform(this,4)"></form>';
            else if($this->table == "transportiration") echo '<td class = "action"><input type = "submit" value = "Изменить"  class = "fadeout" id = "edit" onclick = "return editform(this,2)"></form>';
            else echo'<td class = "action"><input type = "submit" value = "Изменить"  class = "fadeout" id = "edit" onclick = "return editform(this,1)"></form>';
            
            }
            
            //Удаление
        
            if ($this->MakeFormDelete === true) {      
            
                if($this->table == "transportiration") {
    
                    echo'

                    <form action = "?action=deletefromtr" method = "post">
                    <input name = "id" value = "'.$row['arrivalid'].'" class = "invisible">';
                    if ($row['status'] == 1 || $row['stage'] == "Отправлен"  || $row['stage'] == "Сдан в Китай") echo'<input type = "submit" class = "fadeout" value = "Удалить" disabled style = "color:#888 !important;"></form>';
                    else echo '<input type = "submit" class = "fadeout" value = "Удалить" onclick = "return shure()"></form>';
                    
                } else {

                    echo '
                    
                    <div class = "invisible">
                    
                        <form action = "?action=delete" method = "post">
                        <input name = "id" value = "'.$row[$this->fieldnames[count($this->fieldnames)-2]].'">
                        <input name = "table" value = "'.$this->table.'">
                        <input name = "column" value = "'.$this->fieldnames[count($this->fieldnames)-2].'">
                        <input name = "arrivalid" value = "'.$row[$this->fieldnames[count($this->fieldnames)-1]].'">
                    
                    </div>
                    
                    ';
                    
                    
                    if($row['status'] == 1 || $row['stage'] == "Отправлен" || $row['stage'] == "Сдан в Китай") echo'<input type = "submit" class = "fadeout" value = "Удалить" disabled style = "color:#888 !important;"></form>';
                    else echo '<input type = "submit" class = "fadeout" value = "Удалить" onclick = "return shure()"></form>';
                        
                    
                }

            }
            
            echo'
            <a href = "" style = "display:none;">Отменить</a>
            </td>
            ';

            echo '</tr>';
            
        } 

        

    }else {
        echo 'Нет записей';
        }


    include 'include/tablebottom.php';

}


 public function MakeForm() {

    echo '

    <table id = "insertzoomtable">

    <form action = "?action=insert" method = "post" id="">

        <tr id = "insert" class = "hover">

            
    ';

        for ($i=0;$i<count($this->fieldnames)-2;$i++) {
            
            if($this->fieldnames[$i] != "stage" && $this->fieldnames[$i] != "dateofarrive" && $this->fieldnames[$i] != "givingpoint") {
                
                $mystring = $this->fieldnames[$i];
                $findme   = 'date';
                $pos = strpos($mystring, $findme);

                if($pos===false) {                            
                    
                    echo  '<td> <input name = "'.$this->fieldnames[$i].'" placeholder = "'.$this->columns[$i].'"> </td>';
                    
                } else {
                    
                    echo  '<td> <input name = "'.$this->fieldnames[$i].'" placeholder = "'.$this->columns[$i].'" class = "calenpicker"> </td>';

                }
                
            }

        }

        
    echo '

    <td>

    <input type = "submit" value = "Добавить" class = "addbtn">  

    </td>


    <td class = "invisible">

        <input name = "table" value = "'.$this->table.'"

    </td>

    </tr> 

    </form>

    </table>
     
     ';

}

    public function Delete() {
        
        if(!isset($_POST) || $_POST == NULL) {
        
            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
            
            header("Location: {$uri_parts[0]}");
            
            return;
        
        }
        
        $id = $_POST['id'];
        $column = $_POST['column'];
        $arrivalid = $_POST['arrivalid'];

        $result = $this->connection->query("delete from ".$this->table." where $column =".$id);
        
        if($this->table == "loading") {
        
        $this->connection->query("update arrival set status = 0 where idarrival =".$arrivalid);
        
        $this->connection->query("delete from transportiration where arrivalid =".$arrivalid);
        
        $this->connection->query("delete from giving where arrivalid =".$arrivalid);
        
        
        }
        
        header("Location: {$_SERVER['HTTP_REFERER']}");
        
    }
    

    public function Insert() {
        
        if(!isset($_POST) || $_POST == NULL) {
         
         $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
         
         header("Location: {$uri_parts[0]}");
         
         return;
            
        }
        
        $sql = "insert into ".$this->table;
        $fieldsstr = "";
        $valuesstr = "";
        $delim = "";
        
        while ($val = current($_POST)) {
            
            $fn = key($_POST);
        
            $mystring = $fn;
            $findme   = 'date';
            $pos = strpos($mystring, $findme);
            
        
            if ($fn != "table" && $val != "insert" && $fn != "path" && $fn != "image_x" && $fn != "image_y" && $fn != "stage" ) {
        
                $fieldsstr = $fieldsstr.$delim.$fn;
        
                if ($pos===false) {
                    $valuesstr = $valuesstr.$delim."'".$val."'"; 
                } else
                {
                    $valuesstr = $valuesstr.$delim."STR_TO_DATE('".$val."', '%d.%m.%Y')"; 
                }
                $delim = ",";
                
            }
        
            next($_POST);
        }
        
        $sql = $sql.'('.$fieldsstr.') values ('.$valuesstr.')';
        $result = $this->connection->query($sql);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        
        
    }
    

    public function Edit() {
        
        if(!isset($_POST) || $_POST == NULL) {
        
            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
            
            header("Location: {$uri_parts[0]}");
            
            return;
        
        }

        
        $id = $_POST['idtable'];
        
        $idname = $_POST['idname'];
        
        $sql = "update ".$this->table." set ";
        
        $fieldsstr = "";
        $valuesstr = "";
        $delimiter = "";
        
        if($this->table == "loading" || $this->table == "giving" || $this->table == "transportiration") {
        
            if($this->table == "giving") {
            
                while ($val = current($_POST)) {
                    
                    $fn = key($_POST);
                    
                    $mystring = $fn;
                    $findme   = 'date';
                    $pos = strpos($mystring, $findme);
                    
                
                    if ($fn != "table" && $fn != "idtable" && $fn != "idname" && $fn != "arrivalid" && $fn != "container_number" && $fn != "owner" && $fn != "train_number" && $fn != "dateofload" ) {
                
                        $fieldsstr = $valuesstr.$delimiter.$fn; 
                        
                        if ($pos===false) {
                            
                            $valuesstr = $fieldsstr. "= '".$val."'"; 
                            
                        } else {
                            
                            $valuesstr = $fieldsstr. "= STR_TO_DATE('".$val."', '%d.%m.%Y')"; 
                            
                        }
                        
                        $delimiter = ", ";
                
                    }
                
                    next($_POST);
                    
                    
                }
                        
                                
            }
        
            while ($val = current($_POST)) {
                
                $fn = key($_POST);
                
                $mystring = $fn;
                $findme   = 'date';
                $pos = strpos($mystring, $findme);
                        
            
                if ($fn != "table" && $fn != "idtable" && $fn != "idname" && $fn != "arrivalid" && $fn != "container_number" && $fn != "owner" ) {
            
                    $fieldsstr = $valuesstr.$delimiter.$fn; 
                    
                    if ($pos===false) {
                        
                        $valuesstr = $fieldsstr. "= '".$val."'"; 
                        
                    } else {
                            
                            $valuesstr = $fieldsstr. "= STR_TO_DATE('".$val."', '%d.%m.%Y')"; 
                            
                    }
                    
                    $delimiter = ", ";
            
                }
            
                next($_POST);
                
                
            }
            
                        
        } else {
        
            while ($val = current($_POST)) {
                
                $fn = key($_POST);
                
                $mystring = $fn;
                $findme   = 'date';
                $pos = strpos($mystring, $findme);
                
            
                if ($fn != "table" && $fn != "idtable" && $fn != "idname" && $fn != "arrivalid" && $fn != "stage" ) {
            
                    $fieldsstr = $valuesstr.$delimiter.$fn; 
                    
                    if ($pos===false) {
                        
                        $valuesstr = $fieldsstr. "= '".$val."'"; 
                        
                    } else {
                            
                        $valuesstr = $fieldsstr. "= STR_TO_DATE('".$val."', '%d.%m.%Y')"; 
                            
                    }
                    

                    $delimiter = ", ";
            
                }
            
                next($_POST);
                
            }
        
                    
        }
        
        
        
        $sql = $sql." ".$valuesstr." where ".$idname."='".$id."'";
        $result = $this->connection->query($sql);
        
        if($this->table == "loading") {
        
            $train_number =$_POST['train_number'];
            $idarrival =$_POST['arrivalid'];
        
            $sqlforeign = "update transportiration set train_number = '".$train_number."' where arrivalid = ".$idarrival;
        
            $this->connection->query($sqlforeign);
        
        }
        

        header("Location: {$_SERVER['HTTP_REFERER']}");        
    }

}


?>