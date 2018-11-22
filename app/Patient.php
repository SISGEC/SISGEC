<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = ['name', 'lastname', 'nickname', 'sex', 'birthdate', 'scholarship', 'occupation', 'religion', 'civil_status', 'place_of_residence', 'place_of_birth', 'referred_by', 'email', 'phone'];

    public function anamnesis() {
        return $this->hasOne('App\Anamnesis');
    }
}
