<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function medical_appointments() {
        return $this->hasMany('App\MedicalAppointment');
    }

    public function assistants() {
        return $this->hasMany('App\Assistant');
    }
}
