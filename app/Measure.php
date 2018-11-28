<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $table = 'measures';
    protected $fillable = ['weight','height','temperature','heart_rate','blood_pressure', 'breathing_frequency'];

    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function prescription() {
        return $this->belongsTo('App\Prescription');
    }

    public static function get_defaults() {
        return [
            'weight' => '0',
            'height' => '0',
            'temperature' => '0',
            'heart_rate' => '0',
            'blood_pressure' => '0',
            'breathing_frequency' => '0'
        ];
    }
}
