<?php

namespace App\Http\Controllers;

use App\Study;
use App\Patient;
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
        $patiens = Patient::all();
        return view("doctor.patients.index", ["patients" => $patiens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("doctor.patients.new");
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

        $patient = $this->create_new("App\Patient", "patient");
        $anamnesis = $this->create_new("App\Anamnesis", "inherit_family");
        $non_pathological = $this->create_new("App\NonPathological", "non_pathological");
        $pathological_personal = $this->create_new("App\PathologicalPersonal", "pathological");
        $gynecological_obstetric = $this->create_new("App\GynecologicalObstetricHistory", "gyneco_obstetrics");
        $initial_clinical_history = $this->create_new("App\InitialClinicalHistory", "initial_clinical_history");

        $anamnesis->non_pathological()->save($non_pathological);
        $anamnesis->pathological_personal()->save($pathological_personal);
        $anamnesis->gynecological_obstetric_history()->save($gynecological_obstetric);

        $physical_exploration = $this->create_new("App\PhysicalExploration", "physical_exploration");
        $neurological_examination = $this->create_new("App\NeurologicalExamination", "neuro_exam");

        $orientation = $this->create_new("App\Orientation", "orientation");
        $superior_cognitive_functions = $this->create_new("App\SuperiorCognitiveFunctions", "superior_cognitive_functions");
        
        $neurological_examination->orientation()->save($orientation);
        $neurological_examination->superior_cognitive_functions()->save($superior_cognitive_functions);

        $physical_exploration->neurological_examination()->save($neurological_examination);
    
        $initial_clinical_history->anamnesis()->save($anamnesis);
        $initial_clinical_history->physical_exploration()->save($physical_exploration);

        $studies = request()->input("studies", []);
        if(is_array($studies)) {
            $studies = Study::find(array_values($studies));
            $initial_clinical_history->studies()->saveMany($studies);
        }

        $patient->initial_clinical_history()->save($initial_clinical_history);

        $measure = $this->create_new("App\Measure", "measure");
        $patient->measures()->save($measure);

        $patient->save();

        return redirect()->route('patient', ['id' => $patient->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($patient=false)
    {
        if(!$patient) abort(404);
        $patient = Patient::find($patient);
        return view("doctor.patients.self", ["patient" => $patient]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($patient=false)
    {
        if(!$patient) abort(404);
        $patient = Patient::find($patient);
        return view("doctor.patients.edit", ["patient" => $patient]);
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

    private function create_new($model, $group) {
        if($group === "inherit_family") {
            return $model::create(['inherit_family' => request()->input("inherit_family", __('global.denied'))]);
        }
        return $model::create($this->set_defaults(request()->input($group, []), $model::get_defaults()));
    }
}
