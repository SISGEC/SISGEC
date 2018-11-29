<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InitialClinicalHistory extends Model
{
    protected $table = 'initial_clinical_history';
    protected $dates = ['created_at', 'updated_at'];
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
        return $this->hasMany('App\Study')
        ->orderBy('studies.id', 'desc');
    }

    public function tracings() {
        return $this->hasMany('App\Tracing')
        ->orderBy('tracings.id', 'desc');
    }

    public function prescriptions() {
        return $this->hasMany('App\Prescription')
        ->orderBy('prescriptions.id', 'desc');
    }

    public function getFolioAttribute() {
        return str_pad($this->id, 5, '0', STR_PAD_LEFT);
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
