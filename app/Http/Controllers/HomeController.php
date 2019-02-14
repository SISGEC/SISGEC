<?php

namespace App\Http\Controllers;

use App\Settings;
use Carbon\Carbon;
use App\Patient;
use Carbon\CarbonPeriod;
use App\MedicalAppointment;
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
        $notify = [
            [
                "type" => "success",
                "message" => __("global.options_saved_correctly")
            ]
        ];

        if($request->has("options")) {
            foreach ($request->input("options") as $okey => $setting) {
                $this->saveSettingOrCreateNewIfNotExist("app.$okey", $request->input("options.$okey", config("app.$okey")));
            }

            if($request->has("options.office_logo")) {
                if(!config("app.demo_mode")) {
                    $image = $request->file("options.office_logo");
                    $this->saveSettingOrCreateNewIfNotExist("app.office_logo", $this->saveImage($image));
                } else {
                    $notify[] = [
                        "type" => "warning",
                        "message" => "Uploading files in demo mode is not allowed."
                    ];
                }
            }

            if($request->has("options.office_brand")) {
                if(!config("app.demo_mode")) {
                    $image = $request->file("options.office_brand");
                    $this->saveSettingOrCreateNewIfNotExist("app.office_brand", $this->saveImage($image));
                } else {
                    $notify[] = [
                        "type" => "warning",
                        "message" => "Uploading files in demo mode is not allowed."
                    ];
                }
            }
        }

        return redirect()->back()->with("notify", $notify);
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

    private function get_lapse($lapse) {
        if($lapse === "last_week") {
            $end = Carbon::now();
            $start = Carbon::now()->subDays(7);
        } else if($lapse === "last_month") {
            $end = Carbon::now();
            $start = Carbon::now()->subMonth();
        } else {
            $end = Carbon::now();
            $start = Carbon::now()->subYear();
        }
        return (object) [
            "start" => $start,
            "end" => $end
        ];
    }

    private function get_dates_in_lapse($lapse) {
        $period = CarbonPeriod::create($lapse->start->format("Y-m-d"), $lapse->end->format("Y-m-d"));
        $response = [];
        foreach ($period as $date) {
            $response[] = $date->format('Y-m-d');
        }
        return $response;
    }

    private function get_unique_patients_in_date($date) {
        return Patient::whereDate('created_at', '=', $date)->get();
    }

    public function get_unique_appointments_in_date($date) {
        return MedicalAppointment::whereDate('created_at', '=', $date)->get();
    }

    public function monthly_statistics(Request $request, $lapse) {
        if(empty($lapse)) $metric = "last_week";
        $lapse = $this->get_lapse($lapse);
        $period = $this->get_dates_in_lapse($lapse);
        $patients = [];
        $appointments = [];
        $total = 0;

        foreach ($period as $date) {
            $patients[$date] = $this->get_unique_patients_in_date($date)->count();
            $appointments[$date] = $this->get_unique_appointments_in_date($date)->count();
            $total += $patients[$date] + $appointments[$date];
        }

        $response["count"] = count($patients);
        $response["total"] = $total;
        $response["labels"] = [
            "A" => __("global.unique_patients"),
            "B" => __("global.appointments")
        ];
        $response["data"] = [
            "patients" => array_values($patients),
            "appointments" => array_values($appointments)
        ];
        $response["dates"] = array_keys($patients);

        return response()->json($response);
    }
}
