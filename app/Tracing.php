<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracing extends Model
{
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['medication','treatment_response','physical_exploration','diagnostic','treatment_plan_sub','next_appointment_date'];

    public function initial_clinical_history() {
        return $this->belongsTo('App\InitialClinicalHistory');
    }

    public function getNameAttribute() {
        return $this->created_at->timestamp."/".$this->id;
    }

    public static function get_defaults() {
        return array(
            'medication' => "",
            'treatment_response' => "",
            'physical_exploration' => "",
            'diagnostic' => "",
            'treatment_plan_sub' => "",
            'next_appointment_date' => ""
        );
    }
}
