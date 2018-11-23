<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orientation extends Model
{
    protected $fillable = ['time','space','person'];

    public function neurological_examination() {
        return $this->belongsTo('App\NeurologicalExamination');
    }

    public static function get_defaults() {
        return array(
            'time' => '',
            'space' => '',
            'person' => ''
        );
    }
}
