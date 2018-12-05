<?php

namespace App\Http\Controllers;

use App\Tracing;
use App\Patient;
use App\Measure;
use App\Study;
use Illuminate\Http\Request;

class TracingController extends Controller
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
    public function create(Request $request, $id=-1)
    {
        $patient = Patient::find($id);
        if(!is_null($patient)) {
            return view("doctor.tracing.new", ["patient" => $patient]);
        }

        $patients = Patient::all();
        return view("doctor.select_patient", ["patients" => $patients, "route" => "evolution_note.new"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = Patient::find($request->input("patient_id"));
        if(!is_null($patient)) {
            $patient->update( $this->set_defaults($request->input("patient"), Patient::get_defaults()) );

            if($request->has("measure")) {
                $patient->measures()->update(
                    $this->set_defaults($request->input("measure"), Measure::get_defaults())
                );
            }

            if($request->has("tracings")) {
                $tracing = $this->create_new("App\Tracing", "tracings");
                $patient->initial_clinical_history->tracings()->save($tracing);
            }

            $studies = request()->input("studies", []);
            if(is_array($studies)) {
                $studies = Study::find(array_values($studies));
                $patient->initial_clinical_history->studies()->saveMany($studies);
            }

            $patient->save();

            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.the_tracing_has_been_updated_correctly")
                ]
            ];

            return redirect()->route("evolution_note", ["id" => $tracing->id])->with("notify", $notify);
        }
        
        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_tracing_does_not_exist")
            ]
        ];
        return redirect()->back()->with("notify", $notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $tracing = Tracing::find($id);
        if(!is_null($tracing)) {
            $patient = $tracing->initial_clinical_history->patient;
            return view("doctor.tracing.self", ["patient" => $patient, "tracing" => $tracing]);
        }
        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_tracing_does_not_exist")
            ]
        ];
        return response()->back()->with("notify", $notify);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $tracing = Tracing::find($id);
        if(!is_null($tracing)) {
            $patient = $tracing->initial_clinical_history->patient;
            return view("doctor.tracing.edit", ["patient" => $patient, "tracing" => $tracing]);
        }
        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_tracing_does_not_exist")
            ]
        ];
        return response()->back()->with("notify", $notify);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->has("tracing_id")) {
            $tracing = Tracing::find($request->input("tracing_id"));

            if($request->has("patient") && $request->has("patient_id")) {
                $patient = Patient::find($request->input("patient_id"));
                $patient->update( $this->set_defaults($request->input("patient"), Patient::get_defaults()) );
            }

            if($request->has("measure")) {
                if(is_null($patient)) {
                    $patient = $tracing->initial_clinical_history->patient;
                }

                if($patient->measures()->exists()) {
                    $patient->measures()->update(
                        $this->set_defaults($request->input("measure"), Measure::get_defaults()) 
                    );
                } else {
                    $measure = Measure::create($this->set_defaults($request->input("measure"), Measure::get_defaults()));
                    $patient->measures()->save($measure);
                }
            }

            if($request->has("tracings")) {
                $tracing->update(
                    $this->set_defaults($request->input("tracings"), Tracing::get_defaults()) 
                );
            }

            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.the_tracing_has_been_updated_successfully")
                ]
            ];

            return redirect()->route("evolution_note", ["id" => $tracing->id])->with("notify", $notify);
        }

        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_tracing_does_not_exist")
            ]
        ];
        return response()->back()->with("notify", $notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tracing = Tracing::find($id);
        if(!is_null($tracing)) {
            $tracing_name = $tracing->folio;
            $patient = $tracing->initial_clinical_history->patient->id;
            $tracing->delete();
            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.tracing_has_been_removed_successfully")
                ]
            ];
            return redirect()->route('patient', ["id" => $patient])->with("notify", $notify);
        }
        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_tracing_does_not_exist")
            ]
        ];
        return redirect()->back()->with("notify", $notify);
    }

    public function download(Request $request, $id) {
        $doc = $request->query("doc", "tracing");
        if (\View::exists("pdf.$doc")) {
            $tracing = Tracing::find($id);
            if(!is_null($tracing)) {
                $patient = $tracing->initial_clinical_history->patient;
                $pdf_name = str_slug($patient->full_name)."-".str_slug($tracing->name)."-".date('d-m-Y_h_i_a');
                $pdf = \PDF::loadView("pdf.$doc", [
                    "patient" => $patient,
                    "tracing" => $tracing
                ]);
                //return view("pdf.$doc", ["patient" => $patient, "tracing" => $tracing]);
                return $pdf->download("$pdf_name.pdf");
            }
        }

        /**
         * @TODO Add error message
         */
        return redirect()->back();
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
