<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    
    public function initial_clinical_history() {
        return $this->belongs('App\InitialClinicalHistory');
    }

    public function getRealPathAttribute() {
        return public_path("studies/$this->filename");
    }

    public function getPathAttribute() {
        return url("/attachments/show/$this->filename");
    }

    public function getDownloadPathAttribute() {
        return url("/attachments/download/$this->filename");
    }

    public function getScreenshotAttribute() {
        $screenshot = "";

        switch ($this->type) {
            case 'application/pdf':
                $screenshot = asset("/images/icons/pdf.png");
                break;
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/png':
                $screenshot = $this->path;
                break;
            
            default:
                $screenshot = asset("/images/icons/raw.png");
                break;
        }

        return $screenshot;
    }
}
