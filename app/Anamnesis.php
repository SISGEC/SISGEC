<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    protected $table = 'anamnesis';
    protected $fillable = ['inherit_family'];

    public function non_pathological() {
        return $this->hasOne('App\NonPathological');
    }
}
