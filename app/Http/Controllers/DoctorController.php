<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
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
                return redirect()->route("login");
            }

            /**
             * @TODO Add successfull message here
             */
            return redirect()->back();
        }

        /**
         * @TODO add error message here
         */
        return redirect()->back();
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

    public function settings(Request $request) {
        return view("doctor.settings.index");
    }
}
