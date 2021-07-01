<?php

class authorization {

    public $connection;

    public function CheckLogin () {

        session_start();
                    
        if(isset($_SESSION['userid'])) {
            return true; 
        }
        else {
            
            if (isset($_POST["login"]) && isset($_POST["password"])) {   // проверка что мы находимся сразу после ввода логина и пароля

                $login = $_POST["login"];
                $pass = $_POST["password"];
            
                $result = $this->connection->query("SELECT * FROM users where login= '$login' AND password = '$pass'");
                
                if($result->num_rows > 0) {
                    
                    file_put_contents ( 'log1.txt' , 'Проверка успешная!', FILE_APPEND );

                    while($row = $result->fetch_assoc()) {
                    
                        $_SESSION['userid'] = $row['idusers'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['rules'] = $row['rules'];

                    } 
                    
                    header("Location: /", true);
                    return true;
                
                } else {    
                
                    $_SESSION['errormessage'] = 'Неправильный логин или пароль';
                    return false;
                
                }
            
            } else {
                return false;
            }

        }
        
    }
    
    public function Logout() {
        
        session_start();
        unset($_SESSION['userid']);
        
    }        
    

}

?>