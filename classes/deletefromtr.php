<?php
class deletefromtr {
    
    public $connection;
    
    public function TrDelete() {

        if(!isset($_POST) || $_POST == NULL) {
        
            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
            
            header("Location: {$uri_parts[0]}");
            
            return;
        
        }
        
        $id = $_POST['id'];

        $result = $this->connection->query("update loading set train_number = NULL where arrivalid = ".$id);
        $result = $this->connection->query("update transportiration set train_number = NULL where arrivalid = ".$id);
        $result = $this->connection->query("update loading set dateofload = NULL where arrivalid = ".$id);
        $result = $this->connection->query("update transportiration set dateofsending = NULL where arrivalid = ".$id);
        
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
    
} 

?>