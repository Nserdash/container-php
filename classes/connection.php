<?php

class connection {

    private $connection;
    private $connstate;
    private $errormessage;

    public function connectDB() {
    
        if (!isset($this->connection)) {
            
            $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            
            if ($this->connection->connect_errno) {
            
                $this->connstate = 'Ошибка подключения к БД';
                
                return false;
            
            }
            
            $this->connection->set_charset('utf8');
        }
        
       return  $this->connection;
       
    }

    
}

?>