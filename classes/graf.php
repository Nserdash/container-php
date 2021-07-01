<?php
    
    class graf {
        
        public $connection;

        public function CountStatus() {
            
                 
            $result = $this->connection->query("SELECT COUNT(*) as total FROM arrival a WHERE getstage(a.idarrival) = 'Ожидает прибытия'");
            
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $grafparam = $row['total'];
                    
                    
                }
            }   
            
            $a['0'] = $grafparam;
            
                   
            $result = $this->connection->query("SELECT COUNT(*) as total FROM arrival a WHERE getstage(a.idarrival) = 'Прибыл'");
            
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $grafparam = $row['total'];
                    
                    
                }
            }   
            
            $a['1'] = $grafparam;
            
            
            $result = $this->connection->query("SELECT COUNT(*) as total FROM loading l WHERE getstage(l.arrivalid) = 'Погружен'");
            
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $grafparam = $row['total'];
                    
                    
                }
            }   
            
            $a['2'] = $grafparam;
            

            $result = $this->connection->query("SELECT COUNT(*) as total FROM transportiration t WHERE getstage(t.arrivalid) = 'Отправлен'");
            
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $grafparam = $row['total'];
                    
                    
                }
            }   
            
            $a['3'] = $grafparam;
    

            $result = $this->connection->query("SELECT COUNT(*) as total FROM giving g WHERE getstage(g.arrivalid) = 'Сдан в Китай'");
            
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $grafparam = $row['total'];
                    
                    
                }
            }   
    
            $a['4'] = $grafparam;        
            
            $array = new ArrayObject($a);
            return $array;
        }  
        
    }
    ?>