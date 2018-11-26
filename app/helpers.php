<?php

function search_in_array($query, $array=[]) {
    if(!is_array($array)) $array = [];
    if($query==="all") return $array;

    /*$array = array_where($array, function ($value, $key) use ($query){
        return str_is($query, $value);
    });*/

    return array_values($array);
}

function calcule_age($birthdate) {
    $tz  = new DateTimeZone('America/Mexico_City');
    $age = DateTime::createFromFormat('d/m/Y', $birthdate, $tz)
     ->diff(new DateTime('now', $tz))
     ->y;
    return $age;
}