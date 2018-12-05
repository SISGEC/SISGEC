<?php

function array_find($needle, array $haystack) {
    foreach ($haystack as $key => $value) {
        if(str_contains($value, $needle)){
            return $key;
        }
    }
    return false;
}

function filter_array_by($query, $array=[]) {
    if(!is_array($array)) $array = [];
    if($query==="all") return $array;

    $array = array_where($array, function ($value, $key) use ($query){
        return (false !== stripos($value, $query));
    });

    return array_values($array);
}

function calcule_age($birthdate) {
    if(empty($birthdate)) return 0;
    $tz  = new DateTimeZone('America/Mexico_City');
    $age = DateTime::createFromFormat('d/m/Y', $birthdate, $tz)
     ->diff(new DateTime('now', $tz))
     ->y;
    return $age;
}

function is_image($uri) {
    return @is_array(getimagesize($uri));
}

function remove_accents($str) {
    $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
    return strtr( $str, $unwanted_array );
}

function get_doctor_logo($doctor) {
    $logo = config("app.office_logo");
    if(!is_image($logo)) {
        $logo = asset("images/sisgec-logo.png");
    }
    return '<img src="'.$logo.'" />';
}

function doctor() {
    $user = auth()->user();
    if($user->is_doctor()) {
        return $user;
    } else if($user->is_assistant()) {
        return $user->assistant->doctor->user;
    }
    return (object) [];
}