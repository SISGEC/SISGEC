<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonPathological extends Model
{
    protected $fillable = ['living_place','personal_hygiene','sport_activities','hobbies','immunizations','smoking','alcoholism','drug','work_activities','feeding'];

    public function anamnesis(){
        return $this->belongsTo('App\Anamnesis');
    }

    public static function get_defaults() {
        return array(
            'living_place' => __('global.denied'),
            'personal_hygiene' => __('global.denied'),
            'sport_activities' => __('global.denied'),
            'hobbies' => __('global.denied'),
            'immunizations' => __('global.denied'),
            'smoking' => __('global.denied'),
            'alcoholism' => __('global.denied'),
            'drug' => __('global.denied'),
            'work_activities' => __('global.denied'),
            'feeding' => __('global.denied')
        );
    }
}
