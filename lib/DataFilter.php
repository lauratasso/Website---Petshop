<?php

class DataFilter {
    static function alphaNum($data){
        $data = preg_replace("([[:punct:]]| )", '', $data);
        return $data;
    }

    static function numeric($data){
        $data = preg_replace("([[:punct:]]|[[:alpha:]]| )", '', $data);
        return $data;
    }

    static function cleanString($data){
        return addslashes(strip_tags($st_string));
    }

    static function filter($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>
