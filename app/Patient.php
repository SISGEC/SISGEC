<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = ['name', 'lastname', 'nickname', 'sex', 'birthdate', 'scholarship', 'occupation', 'religion', 'civil_status', 'place_of_residence', 'place_of_birth', 'referred_by', 'email', 'phone'];

    public function initial_clinical_history() {
        return $this->hasOne('App\InitialClinicalHistory');
    }

    public static function get_defaults() {
        return array(
            'nickname' => '',
            'birthdate' => '',
            'scholarship' => '',
            'occupation' => '',
            'religion' => '',
            'civil_status' => '',
            'place_of_residence' => '',
            'place_of_birth' => '',
            'referred_by' => '',
            'email' => '',
            'phone' => ''
        );
    }

    public function getFullNameAttribute() {
        return ucfirst($this->name) . " " . ucfirst($this->lastname);
    }

    public function getAgeAttribute() {
        if(is_null($this->birthdate)) return "";
        return calcule_age($this->birthdate);
    }
}
