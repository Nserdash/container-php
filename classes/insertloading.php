<?php
    
    class insertloading {
    
         public function InsertL() {
            
            if(!isset($_POST) || $_POST == NULL) {
            
                $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
                
                header("Location: {$uri_parts[0]}");
                
                return;
            
            }
            
            $id = $_POST['id'];
            $ex = $_POST['executor'];
            $tn = $_POST['train_number'];
            $dol = $_POST['dateofloading'];
            $own = $_POST['owner'];
            $loadingpoint = $_POST['loadingpoint'];
            $customer = $_POST['customer'];
    
            $result = $this->connection->query(
            
            "insert into loading (executor, train_number, customer, loadingpoint, dateofload, arrivalid)
            values ('".$ex."', '".$tn."', '".$customer."', '".$loadingpoint."', STR_TO_DATE('".$dol."', '%d.%m.%Y'), '".$id."')"
            
            
            );
            
            $this->connection->query(
            
            "insert into transportiration (train_number, arrivalid)
            values ('".$tn."','".$id."')"
            
            );
            
            $this->connection->query(
            
            "insert into giving (arrivalid)
            values ('".$id."')"
            
            );
                
            
            $this->connection->query("update arrival set status = 1 where idarrival =".$id);
            
            header("Location: {$_SERVER['HTTP_REFERER']}");        
            
     }
    }        
    ?>