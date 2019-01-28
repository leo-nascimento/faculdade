<?php

// Classe designada a validacao de dados

class DataValidator {

    // Verifica se o dado passado está vazio
    static function isEmpty($value){
        if(!(strlen($value) > 0))
            return true;
        return false;
    }

    // Verifica se o dado passado é númerico
    static function isNumeric($value) {
        $value = str_replace(',', '.', $value);
        if(!is_numeric($value))
            return false;
        return true;
    }

    // Retira pontuação de uma string
    static function alphaNum($data){
        $data = preg_replace("[[:punct:]]| ", '', $data);
        return $data;
    }

    // Valida um e-mail
    static function validateMail($mail){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            return true;
        return false;
    }

    // Validar username
    static function validateUsername($user){
        if($user[0] === '@' && strlen($user) > 2)
            return true;
        return false;
    }

    // Validar data
    static function validateDate($date){
        $day = $date[0].$date[1];
        $month = $date[2].$date[3];
        $year = $date[4].$date[5].$date[6].$date[7];
        $current = date("Y-m-d");
        $date = date("Y-m-d", $date);
        if($day === 00 || $day > 31)
            return false;
        if($month === 00 || $month > 12)
            return false;
        if($year[0] === 0)
            return false;
        if($current < $date)
            return false;

        return true;
    }
}