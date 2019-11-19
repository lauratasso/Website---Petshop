<?php

class DataValidator {
    static function isEmpty($data){
        return strlen($data) == 0 ? true : false;
    }

    static function isNumeric( $data ){
        $value = str_replace(',', '.', $data);
        return is_numeric($value);
    }

    static function isInteger( $data ){
        if( ! DataValidator::isNumeric($data) )
            return false;
        return preg_match('/[[:punct:]&^-]/', $data) > 0 ? false : true;
    }
}
?>