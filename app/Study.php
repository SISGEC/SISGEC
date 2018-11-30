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
        $path = url("/attachments/show/$this->filename");
        if($this->is_rendereable()) {
            return sprintf("https://docs.google.com/viewer?url=%s", $path);
        }
        return $path;
    }

    public function getDownloadPathAttribute() {
        return url("/attachments/download/$this->filename");
    }

    public function getTypeNameAttribute() {
        if($this->is_pdf()) {
            return "PDF";
        } else if($this->is_doc()) {
            return "DOC";
        } else if($this->is_image()) {
            return strtoupper($this->type);
        } else if($this->is_video()) {
            return "VIDEO";
        } else if($this->is_spreadsheet()) {
            return "EXCEL";
        } else if($this->is_plain_text()) {
            return "TEXT";
        }
        return "undefined";
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

    public function is_image() {
        return $this->is("image");
    }

    public function is_pdf() {
        return $this->is("pdf");
    }

    public function is_video() {
        return $this->is("video");
    }

    public function is_doc() {
        return $this->is("vnd.openxmlformats-officedocument.wordprocessingml.document") || 
                $this->is("docx") || $this->is("msword");
    }

    public function is_spreadsheet() {
        return $this->is("vnd.openxmlformats-officedocument.spreadsheetml.sheet") || 
                $this->is("vnd.ms-excel");
    }

    public function is_plain_text() {
        return $this->is("plain");
    }

    public function is_rendereable() {
        return !($this->is_image() || $this->is_video() || $this->is_spreadsheet());
    }

    public function is($type_name) {
        if(!empty($this->type)) {
            $g = explode("/", $this->type);
            return $g[0] === $type_name || $g[1] === $type_name;
        }
        return false;
    }
}
