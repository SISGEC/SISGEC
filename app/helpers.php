<?php

function search_in_array($query, $array=[]) {
    if(!is_array($array)) $array = [];
    if($query==="all") return $array;

    /*$array = array_where($array, function ($value, $key) use ($query){
        return str_is($query, $value);
    });*/

    return array_values($array);
}