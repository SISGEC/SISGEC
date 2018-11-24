<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InitialClinicalHistory extends Model
{
    protected $table = 'initial_clinical_history';
    protected $fillable = ['current_condition','diagnostical_impression','treatment_plan','interconsultation','treatment'];

    public function anamnesis() {
        return $this->hasOne('App\Anamnesis');
    }

    public function physical_exploration() {
        return $this->hasOne('App\PhysicalExploration');
    }

    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function studies() {
        return $this->hasMany('App\Study');
    }

    public static function get_defaults() {
        return array(
            'current_condition' => "",
            'diagnostical_impression' => "",
            'treatment_plan' => "",
            'interconsultation' => "",
            'treatment' => ""
        );
    }
}
