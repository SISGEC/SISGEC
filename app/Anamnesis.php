<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    protected $table = 'anamnesis';
    protected $fillable = ['inherit_family'];

    public function non_pathological() {
        return $this->hasOne('App\NonPathological');
    }

    public function pathological_personal() {
        return $this->hasOne('App\PathologicalPersonal');
    }

    public function gynecological_obstetric_history() {
        return $this->hasOne('App\GynecologicalObstetricHistory');
    }

    public function initial_clinical_history() {
        return $this->belongsTo('App\InitialClinicalHistory');
    }

    public static function get_defaults() {
        return [
            'inherit_family' => __("global.denied")
        ];
    }
}
