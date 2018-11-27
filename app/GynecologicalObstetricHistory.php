<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GynecologicalObstetricHistory extends Model
{
    protected $fillable = ['ivsa','menarca','fur','came','pregnancies_number','births_number','abortions_number','ets','cesareans_number','uma','other_gyneco_info','last_papanicolaou_date','last_mammogram_date'];

    public function anamnesis(){
        return $this->belongsTo('App\Anamnesis');
    }

    public static function get_defaults() {
        return array(
            'ivsa' => __('global.denied'),
            'menarca' => __('global.denied'),
            'fur' => __('global.denied'),
            'came' => __('global.denied'),
            'pregnancies_number' => __('global.denied'),
            'births_number' => __('global.denied'),
            'abortions_number' => __('global.denied'),
            'ets' => __('global.denied'),
            'cesareans_number' => __('global.denied'),
            'uma' => __('global.denied'),
            'other_gyneco_info' => __('global.denied'),
            'last_papanicolaou_date' => __('global.denied'),
            'last_mammogram_date' => __('global.denied')
        );
    }
}
