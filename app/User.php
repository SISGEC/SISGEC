<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $attributes = [
        'title' => '',
        'lastname' => ''
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function doctor() {
        return $this->hasOne('App\Doctor');
    }

    public function assistant() {
        return $this->hasOne('App\Assistant');
    }

    public function is_doctor() {
        return $this->role === "1";
    }

    public function is_admin() {
        return $this->role === "2";
    }

    public function is_assistant() {
        return $this->role === "3";
    }

    public function get_role() {
        if($this->is_admin()) {
            return "admin";
        } else if($this->is_doctor()) {
            return "doctor";
        } else {
            return "assistant";
        }
    }

    public function getFullNameAttribute() {
        return ucfirst($this->name) . " " . ucfirst($this->lastname);
    }

    public function getFormalNameAttribute() {
        return ucfirst($this->title) . " " . ucfirst($this->name) . " " . ucfirst($this->lastname);
    }

    public function getSpecialtyAttribute() {
        if($this->is_doctor()) {
            return $this->doctor->specialty;
        }
        return false;
    }

    public function getUniversityAttribute() {
        if($this->is_doctor()) {
            return $this->doctor->university;
        }
        return false;
    }

    public function getProfessionalLicenseAttribute() {
        if($this->is_doctor()) {
            return $this->doctor->professional_license;
        }
        return false;
    }

    public function getMedicalAppointmentsAttribute() {
        return $this->doctor->medical_appointments;
    }

    public function getDoctorIdAttribute() {
        return $this->doctor->id;
    }

    public function medical_appointments() {
        return $this->doctor->medical_appointments();
    }
}
