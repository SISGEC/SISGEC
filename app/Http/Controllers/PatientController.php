<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Anamnesis;
use App\NonPathological;
use App\PathologicalPersonal;
use App\GynecologicalObstetricHistory;
use App\InitialClinicalHistory;
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

        $patient = Patient::create($this->set_defaults($request->input("patient"), Patient::get_defaults()));
        $anamnesis = Anamnesis::create(['inherit_family' => $request->input("inherit_family", __('global.denied'))]);
        $non_pathological = NonPathological::create($this->set_defaults($request->input("non_pathological"), NonPathological::get_defaults()));
        $pathological_personal = PathologicalPersonal::create($this->set_defaults($request->input("pathological"), PathologicalPersonal::get_defaults()));
        $gynecological_obstetric = GynecologicalObstetricHistory::create($this->set_defaults($request->input("gyneco_obstetrics"), GynecologicalObstetricHistory::get_defaults()));
        $initial_clinical_history = InitialClinicalHistory::create($this->set_defaults($request->input("initial_clinical_history"), InitialClinicalHistory::get_defaults()));

        $anamnesis->non_pathological()->save($non_pathological);
        $anamnesis->pathological_personal()->save($pathological_personal);
        $anamnesis->gynecological_obstetric_history()->save($gynecological_obstetric);

        $physical_exploration = PhysicalExploration::create($this->set_defaults($request->input("physical_exploration"), PhysicalExploration::get_defaults()));
        $neurological_examination = NeurologicalExamination::create($this->set_defaults($request->input("neuro_exam"), NeurologicalExamination::get_defaults()));
        
        $physical_exploration->neurological_examination()->save($neurological_examination);
    
        $initial_clinical_history->anamnesis()->save($anamnesis);

        $patient->initial_clinical_history()->save($initial_clinical_history);

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

    private function set_defaults($inputs, $defaults=[]) {
        $data = [];
        //if(!is_array($inputs)) $inputs = [];
        foreach ($inputs as $key => $value) {
            if(empty($value)) {
                if(array_key_exists($key, $defaults)) {
                    $data[$key] = $defaults[$key];
                } else {
                    $data[$key] = "";
                }
            } else {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}
