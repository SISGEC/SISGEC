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

    public function is_doctor() {
        return $this->role === "1";
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
}
