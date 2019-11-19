<?php

class FactoryDatabase {
    static function get(){
        $server     = "fdb24.awardspace.net";
        $user       = "3025470_databasepi";
        $password   = "databasePI1234";
        $database   = "3025470_databasepi";
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