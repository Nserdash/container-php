<?php
    
class trainslist {
    
    public $connection;
    public $fieldnames;
    public $columns;
    public $query;
    
    public function Tlist() {

        $result = $this->connection->query($this->query);
    
        // where dateofload > текущая дата минус месяц
        
        if ($result->num_rows > 0) {
        
            echo'<table class = "files">
        
            <tr>
        
                <thead class = "onlypc">
        
                <th>
                Номер поезда
                </th>

                <th>
                Дата Отправки
                </th>

                </thead>
        
            </tr>
        
            ';
        
            while($row = $result->fetch_assoc()) {
        
                echo  '
                    
                    <tr class= "hover">
        
                    <td class = "tablerow">
                    <div class = "mobileth mobile">
                    Номер поезда
                    </div>
                     
        
                        <b>
                        <a href = "/Формирование поезда?train_number='.$row['train_number'].'"><u><p>'.$row['train_number'].'</p></u></a>
                        </b>
        
                    </td>

        
                    <td class = "tablerow">
                    <div class = "mobileth mobile">
                    Дата отправки
                    </div>
                    '.$row['dateofsending'].'</td>
        
                    </tr>        
                
                ';
                
                
            }
        
            echo '</table>';
        
        } else {
        
        echo 'Нет погруженных контейнеров за данный период';
            
        }
            
    }
    
}    
?>