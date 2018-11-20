<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonPathological extends Model
{
    protected $fillable = ['living_place','personal_hygiene','sport_activities','hobbies','immunizations','smoking','alcoholism','drug','work_activities','feeding'];

    public function anamnesis(){
        return $this->belongsTo('App\Anamnesis');
    }
}
