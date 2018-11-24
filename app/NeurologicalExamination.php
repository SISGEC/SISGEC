<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NeurologicalExamination extends Model
{
    protected $fillable = ['mental_examination','language','memory','hallucinations','delusions','esape','cranial_nerves','actor_system','sensitive_system','vestibular_system','meninges'];

    public function physical_exploration() {
        return $this->belongsTo('App\PhysicalExploration');
    }

    public function orientation() {
        return $this->hasOne('App\Orientation');
    }

    public function superior_cognitive_functions() {
        return $this->hasOne('App\SuperiorCognitiveFunctions');
    }

    public static function get_defaults() {
        return array(
            'mental_examination' => "",
            'language' => "",
            'memory' => "",
            'hallucinations' => "",
            'delusions' => "",
            'esape' => "",
            'cranial_nerves' => "",
            'actor_system' => "",
            'sensitive_system' => "",
            'vestibular_system' => "",
            'meninges' => ""
        );
    }
}
