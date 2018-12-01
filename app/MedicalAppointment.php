<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalAppointment extends Model
{
    protected $dates = ['created_at', 'updated_at', 'date'];
    protected $fillable = ['date','title','description'];

    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function doctor() {
        return $this->belongsTo('App\Doctor');
    }
}
