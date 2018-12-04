<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function doctor() {
        return $this->belongsTo('App\Doctor');
    }

    public function getFullNameAttribute() {
        if(is_null($this->user)) return "";
        return ucfirst($this->user->name) . " " . ucfirst($this->user->lastname);
    }

    public function getNameAttribute() {
        if(is_null($this->user)) return "";
        return $this->user->name;
    }

    public function getLastnameAttribute() {
        if(is_null($this->user)) return "";
        return $this->user->lastname;
    }

    public function getEmailAttribute() {
        if(is_null($this->user)) return "";
        return $this->user->email;
    }

    public function getPhoneAttribute() {
        if(is_null($this->user)) return "";
        return $this->user->phone;
    }

    public function getTitleAttribute() {
        if(is_null($this->user)) return "";
        return $this->user->title;
    }
}
