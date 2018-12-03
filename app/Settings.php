<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = "configs";
    protected $fillable = ['key', 'value'];
    
    public function loadInMemory() {
        if($this->key === "app.lang") {
            \App::setLocale($this->value);
            return;
        }
        \Config::set($this->key, $this->value);
    }
}
