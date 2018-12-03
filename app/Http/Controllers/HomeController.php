<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $images_path;

    public function __construct()
    {
        $this->images_path = public_path('/images');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctor.desktop');
    }

    public function options(Request $request) {

        if($request->has("options")) {
            foreach ($request->input("options") as $okey => $setting) {
                $this->saveSettingOrCreateNewIfNotExist("app.$okey", $request->input("options.$okey", config("app.$okey")));
            }

            if($request->has("options.office_logo")) {
                $image = $request->file("options.office_logo");
                $this->saveSettingOrCreateNewIfNotExist("app.office_logo", $this->saveImage($image));
            }

            if($request->has("options.office_brand")) {
                $image = $request->file("options.office_brand");
                $this->saveSettingOrCreateNewIfNotExist("app.office_brand", $this->saveImage($image));
            }
        }

        /**
         * @TODO Add return message
         */
        return redirect()->back();
    }

    public function saveSettingOrCreateNewIfNotExist($key, $value) {
        $setting = Settings::where("key", $key)->first();
        if(!is_null($setting)) {
            $setting->update([
                'key' => $key,
                'value' => $value
            ]);
        } else {
            $setting = Settings::create([
                'key' => $key,
                'value' => $value
            ]);
        }
        return $setting;
    }

    public function saveImage($image) {
        if (!is_dir($this->images_path)) {
            mkdir($this->images_path, 0777);
        }
        $name = sha1(date('YmdHis') . str_random(30));
        $save_name = $name . '.' . $image->getClientOriginalExtension();
        $image->move($this->images_path, $save_name);
        return asset("images/$save_name"); 
    }
}
