<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PathologicalPersonal extends Model
{
    protected $fillable = ['childhood_diseases','surgical_operations','accidents','traumatic_brain_injury','allergies','disabilities','blood_transfusions'];
    
    public function anamnesis(){
        return $this->belongsTo('App\Anamnesis');
    }
}
