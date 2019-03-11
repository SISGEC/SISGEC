<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $attributes = [
        'lastname' => ''
    ];

    protected $fillable = ['name', 'lastname', 'nickname', 'sex', 'birthdate', 'scholarship', 'occupation', 'religion', 'civil_status', 'place_of_residence', 'place_of_birth', 'referred_by', 'email', 'rfc', 'phone'];

    public function initial_clinical_history() {
        return $this->hasOne('App\InitialClinicalHistory');
    }

    public function measures() {
        return $this->hasOne('App\Measure');
    }

    public function medical_appointments() {
        return $this->hasMany('App\MedicalAppointment');
    }

    public static function get_defaults() {
        return array(
            'nickname' => '-',
            'birthdate' => '-',
            'scholarship' => '-',
            'occupation' => '-',
            'religion' => '-',
            'civil_status' => '-',
            'place_of_residence' => '-',
            'place_of_birth' => '-',
            'referred_by' => '-',
            'email' => '-',
            'rfc' => '-',
            'phone' => '-'
        );
    }

    public function getFullNameAttribute() {
        return ucfirst($this->name) . " " . ucfirst($this->lastname);
    }

    public function getAgeAttribute() {
        if(is_null($this->birthdate)) return "";
        return calcule_age($this->birthdate);
    }

    public function getLastUpdateAttribute() {
        $lv = $this->updated_at;
        $ltc = $this->initial_clinical_history->tracings()->count();
        if($ltc > 0) {
            $ltv = $this->initial_clinical_history->tracings->last()->updated_at;
            if($ltv > $lv) {
                return $ltv;
            }
        }
        return $lv;
    }

    public function getTotalVisitsAttribute() {
        $tv = $this->initial_clinical_history->tracings()->count() + 1; // tracings + 1rst visit
        return trans_choice("global.visits", $tv);
    }

    public static function all_in_suggestion_format() {
        $patients = Patient::all();
        $result = [];
        foreach($patients as $patient) {
            $result[] = [
                "value" => $patient->full_name,
                "data" => route("patient", ["id" => $patient->id])
            ];
        }
        return $result;
    }

    public static function find_in_suggestion_format($query="") {
        $suggestions = Patient::all_in_suggestion_format();
        foreach($suggestions as $skey => $suggestion) {
            $query = strtolower(remove_accents($query));
            $suggs = strtolower(remove_accents($suggestion['value']));
            if(!str_contains($suggs, $query)) {
                unset($suggestions[$skey]);
            }
        }
        return $suggestions;
    }
}
