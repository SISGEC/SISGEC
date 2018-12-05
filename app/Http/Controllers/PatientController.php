<?php

namespace App\Http\Controllers;

use App\Study;
use App\Patient;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $patiens = Patient::orderBy('created_at', 'desc')->get();
        return view("doctor.patients.index", ["patients" => $patiens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = auth()->user()->get_role();
        return view("$role.patients.new");
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

        $notify = [
            [
                "type" => "success",
                "message" => __("global.patient_created_correctly")
            ]
        ];

        return redirect()->route('patient', ['id' => $patient->id])->with("notify", $notify);
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
        $role = auth()->user()->get_role();
        return view("$role.patients.self", ["patient" => $patient]);
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
        $role = auth()->user()->get_role();
        return view("$role.patients.edit", ["patient" => $patient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->has("id")) {
            $patient = Patient::find($request->input("id"));
            
            if(!is_null($patient)) {
                $patient->update( $this->set_defaults($request->input("patient"), Patient::get_defaults()) );
                if($request->has("measure")) {
                    $patient->measures()->update(
                        $this->set_defaults($request->input("measure"), \App\Measure::get_defaults())
                    );
                }

                if($request->has("initial_clinical_history")) {
                    $patient->initial_clinical_history()->update(
                        $this->set_defaults($request->input("initial_clinical_history"), \App\InitialClinicalHistory::get_defaults())
                    );
                }

                if($request->has("inherit_family")) {
                    $patient->initial_clinical_history->anamnesis()->update([
                        'inherit_family' => $request->input("inherit_family", \App\Anamnesis::get_defaults()["inherit_family"])
                    ]);
                }

                if($request->has("non_pathological")) {
                    $patient->initial_clinical_history->anamnesis->non_pathological()->update(
                        $this->set_defaults($request->input("non_pathological"), \App\NonPathological::get_defaults())
                    );
                }

                if($request->has("pathological")) {
                    $patient->initial_clinical_history->anamnesis->pathological_personal()->update(
                        $this->set_defaults($request->input("pathological"), \App\PathologicalPersonal::get_defaults())
                    );
                }

                if($request->has("gyneco_obstetrics")) {
                    $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history()->update(
                        $this->set_defaults($request->input("gyneco_obstetrics"), \App\GynecologicalObstetricHistory::get_defaults())
                    );
                }

                if($request->has("physical_exploration")) {
                    $patient->initial_clinical_history->physical_exploration()->update(
                        $this->set_defaults($request->input("physical_exploration"), \App\PhysicalExploration::get_defaults())
                    );
                }

                if($request->has("neuro_exam")) {
                    $patient->initial_clinical_history->physical_exploration->neurological_examination()->update(
                        $this->set_defaults($request->input("neuro_exam"), \App\NeurologicalExamination::get_defaults())
                    );
                }

                if($request->has("orientation")) {
                    $patient->initial_clinical_history->physical_exploration->neurological_examination->orientation()->update(
                        $this->set_defaults($request->input("orientation"), \App\Orientation::get_defaults())
                    );
                }

                if($request->has("superior_cognitive_functions")) {
                    $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions()->update(
                        $this->set_defaults($request->input("superior_cognitive_functions"), \App\SuperiorCognitiveFunctions::get_defaults())
                    );
                }

                $studies = $request->input("studies", []);
                if(is_array($studies)) {
                    $studies = Study::find(array_values($studies));
                    $patient->initial_clinical_history->studies()->saveMany($studies);
                }
                
                $patient->save();
                $notify = [
                    [
                        "type" => "success",
                        "message" => __("global.the_patients_history_has_been_updated_correctly")
                    ]
                ];
                return redirect()->route("patient", ["id" => $patient->id])->with("notify", $notify);
            }
        }
        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_patient_does_not_exist")
            ]
        ];
        return redirect()->back()->with("notify", $notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if(!is_null($patient)) {
            $patient_name = $patient->name;
            $patient->delete();
            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.remove_patient_done")
                ]
            ];
            return redirect()->route('patients')->with("notify", $notify);
        }
        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_patient_does_not_exist")
            ]
        ];
        return redirect()->route('patients')->with("notify", $notify);
    }

    public function download(Request $request, $id) {
        $doc = $request->query("doc", "initial");
        if (\View::exists("pdf.$doc")) {
            $patient = Patient::find($id);
            if(!is_null($patient)) {
                $pdf_name = str_slug($patient->full_name)."-$doc-".date('d-m-Y_h_i_a');
                $pdf = \PDF::loadView("pdf.$doc", [
                    "patient" => $patient
                ]);
                return $pdf->download("$pdf_name.pdf");
                //return $pdf->stream("$pdf_name.pdf");
                //return view("pdf.$doc", ["patient" => $patient]);
            }
        }

        /**
         * @TODO Add error message
         */
        return redirect()->back();
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

    private function get_patients_treated($lapse) {
        return Patient::where([
            ["updated_at", ">=", $lapse->start],
            ["updated_at", "<=", $lapse->end]
        ])->get();
    }

    private function get_patients_treated_in_date($date) {
        return Patient::whereDate('updated_at', '=', $date)->get();
    }

    private function get_unique_patients_in_date($date) {
        return Patient::whereDate('created_at', '=', $date)->get();
    }

    private function get_dates_in_lapse($lapse) {
        $period = CarbonPeriod::create($lapse->start->format("Y-m-d"), $lapse->end->format("Y-m-d"));
        $response = [];
        foreach ($period as $date) {
            $response[] = $date->format('Y-m-d');
        }
        return $response;
    }

    public function statistics(Request $request, $metric, $lapse) {
        if(empty($metric)) $metric = "patients_treated";
        if(empty($lapse)) $metric = "last_week";
        $lapse = $this->get_lapse($lapse);
        $period = $this->get_dates_in_lapse($lapse);
        $patients = [];
        $total = 0;

        if($metric === "patients_treated") {
            foreach ($period as $date) {
                $patients[$date] = $this->get_patients_treated_in_date($date)->count();
                $total += $patients[$date];
            }
        } else if($metric === "unique_patients") {
            foreach ($period as $date) {
                $patients[$date] = $this->get_unique_patients_in_date($date)->count();
                $total += $patients[$date];
            }
        }

        $response["count"] = count($patients);
        $response["total"] = $total;
        $response["data"] = $patients;
        $response["sparkline"] = array_values($patients);

        return response()->json($response);
    }

    private function set_defaults($inputs, $defaults=[]) {
        $data = [];
        if(!is_array($inputs)) $inputs = [$inputs];
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
