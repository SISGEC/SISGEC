<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    
    public function initial_clinical_history() {
        return $this->belongs('App\InitialClinicalHistory');
    }
}
