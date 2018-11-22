<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GynecologicalObstetricHistory extends Model
{
    protected $fillable = ['ivsa','menarca','fur','came','pregnancies_number','births_number','abortions_number','ets','cesareans_number','uma','other_gyneco_info','last_papanicolaou_date','last_mammogram_date'];

    public function anamnesis(){
        return $this->belongsTo('App\Anamnesis');
    }
}
