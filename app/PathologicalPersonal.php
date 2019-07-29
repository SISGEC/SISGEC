<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PathologicalPersonal extends Model
{
    protected $fillable = ['childhood_diseases','surgical_operations','accidents','traumatic_brain_injury','allergies','disabilities','blood_transfusions', 'suicidal_risk'];
    
    public function anamnesis(){
        return $this->belongsTo('App\Anamnesis');
    }

    public static function get_defaults() {
        return array(
            'childhood_diseases' => __('global.denied'),
            'surgical_operations' => __('global.denied'),
            'accidents' => __('global.denied'),
            'traumatic_brain_injury' => __('global.denied'),
            'allergies' => __('global.denied'),
            'disabilities' => __('global.denied'),
            'blood_transfusions' => __('global.denied'),
            'suicidal_risk' => __('global.denied')
        );
    }
}
