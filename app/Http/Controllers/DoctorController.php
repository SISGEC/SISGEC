<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->input("user_id"));
        $doctor = Doctor::find($request->input("doctor_id"));

        if(!is_null($user) && !is_null($doctor)) {
            if($request->has("user")) {
                $user->name = $request->input("user.name", $user->name);
                $user->lastname = $request->input("user.lastname", $user->lastname);
                $user->email = $request->input("user.email", $user->email);
                $user->title = $request->input("user.title", $user->title);
                $user->phone = $request->input("user.phone", $user->phone);
            }

            if($request->has("doctor")) {
                $doctor->specialty = $request->input("doctor.specialty", $doctor->specialty);
                $doctor->university = $request->input("doctor.university", $doctor->university);
                $doctor->professional_license = $request->input("doctor.professional_license", $doctor->professional_license);
            }

            if($request->has("probatium")) {
                $this->saveSettingOrCreateNewIfNotExist("app.probatium.ip", $request->input("probatium.ip", config("app.probatium.ip")));
            }

            if($request->has("password")) {
                $request->validate([
                    'password.new' => 'required|min:6|',
                    'password.confirm' => 'required|same:password.new',
                ]);

                $user->password = bcrypt($request->input("password.new"));
            }

            $user->save();
            $doctor->save();

            if($request->has("password")) {
                Auth::logout();
                $notify = [
                    [
                        "type" => "success",
                        "message" => __("global.your_password_has_been_changed_correctly_please_sign_in_again")
                    ]
                ];
                return redirect()->route("login")->with("notify", $notify);
            }

            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.options_saved_correctly")
                ]
            ];
            return redirect()->back()->with("notify", $notify);
        }

        $notify = [
            [
                "type" => "error",
                "message" => __("global.an_error_occurred_while_saving")
            ]
        ];
        return redirect()->back()->with("notify", $notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
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

    public function settings(Request $request) {
        $role = auth()->user()->get_role();
        return view("$role.settings.index");
    }
}
