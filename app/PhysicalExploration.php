<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhysicalExploration extends Model
{
    protected $fillable = ['general_appearance','head','neck','chest','abdomen','back','extremities','genitals'];

    public function neurological_examination() {
        return $this->hasOne('App\NeurologicalExamination');
    }

    public function initial_clinical_history() {
        return $this->belongsTo('App\InitialClinicalHistory');
    }

    public static function get_defaults() {
        return array(
            'general_appearance' => __("global.denied"),
            'head' => __("global.denied"),
            'neck' => __("global.denied"),
            'chest' => __("global.denied"),
            'abdomen' => __("global.denied"),
            'back' => __("global.denied"),
            'extremities' => __("global.denied"),
            'genitals' => __("global.denied")
        );
    }
}
