<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Anamnesis;
use App\NonPathological;
use App\PathologicalPersonal;
use App\GynecologicalObstetricHistory;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("doctor.patients_new");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient.name' => 'required',
            'patient.lastname' => 'required',
            'patient.sex' => 'required',
            'patient.email' => 'email'
        ]);

        $patient = Patient::create($request->input("patient"));
        $anamnesis = Anamnesis::create(['inherit_family' => $request->input("inherit_family")]);
        $non_pathological = NonPathological::create($request->input("non_pathological"));
        $pathological_personal = PathologicalPersonal::create($request->input("pathological"));
        $gynecological_obstetric = GynecologicalObstetricHistory::create($request->input("gyneco_obstetrics"));

        $anamnesis->non_pathological()->save($non_pathological);
        $anamnesis->pathological_personal()->save($pathological_personal);
        $anamnesis->gynecological_obstetric_history()->save($gynecological_obstetric);

        $patient->anamnesis()->save($anamnesis);

        dd($patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
