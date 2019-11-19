<?php

class FactoryDatabase {
    static function get(){
        $server     = "SERVER_DATABASE";  //insert the data of database created
        $user       = "USER_DATABASE";
        $password   = "PASSWORD_USER";
        $database   = "NAME_DATABASE";
        $connection = new mysqli($server, $user, $password, $database);
        return $connection;
    }

    static function close(&$connection){
        try {
            $connection->close();
        } catch(Exception $e){
            // PASS
        }
    }
}


?>
