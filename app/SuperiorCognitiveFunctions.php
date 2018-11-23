<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperiorCognitiveFunctions extends Model
{
    protected $fillable = ['abstract','concrete','literal','magical','arithmetic_calculation','ability_to_draw'];

    public function neurological_examination() {
        return $this->belongsTo('App\NeurologicalExamination');
    }

    public static function get_defaults() {
        return array(
            'abstract' => '',
            'concrete' => '',
            'literal' => '',
            'magical' => '',
            'arithmetic_calculation' => '',
            'ability_to_draw' => ''
        );
    }
}
