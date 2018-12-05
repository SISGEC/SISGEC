<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Prescription;
use App\Measure;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(!$id) abort(404);
        $prescription = Prescription::find($id);
        return view("doctor.prescriptions.self", ["prescription" => $prescription]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->has("patient_id")) {
            $patient = Patient::find($request->query("patient_id"));
            $new_folio = Prescription::next_folio();
            return view("doctor.prescriptions.new", [
                "patient" => $patient,
                "new_folio" => $new_folio
            ]);
        }
        $patients = Patient::all();
        return view("doctor.select_patient", ["patients" => $patients, "route" => "prescription.new"]);
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
        $last = Prescription::all();
        $last = $last->last();
        $folio = 0;
        if(!is_null($last)) {
            $folio = $last->folio + 1;
        }
        $prescription = new Prescription;
        $prescription->date = $request->input("date", date("d/m/Y"));
        $prescription->prescription = $request->input("prescription", "");

        $measure = Measure::create($this->set_defaults($request->input("measure"), Measure::get_defaults()));
        $measure->patient_id = $patient->id;

        $prescription->measures()->save($measure);

        $patient->initial_clinical_history->prescriptions()->save($prescription);

        $notify = [
            [
                "type" => "success",
                "message" => __("global.prescription_created_successfully")
            ]
        ];

        return redirect()->route("prescription", ["id" => $prescription->id])->with("notify", $notify);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prescription  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id=false)
    {
        if(!$id) abort(404);
        $prescription = Prescription::find($id);
        return view("doctor.prescriptions.edit", ["prescription" => $prescription]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prescription  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $prescription = Prescription::find($request->input("prescription_id"));
        if(!is_null($prescription)) {
            if($request->has("date")) {
                $prescription->date = $request->input("date");
            }

            if($request->has("measure")) {
                if($prescription->measures()->exists()) {
                    $prescription->measures()->update(
                        $this->set_defaults($request->input("measure"), Measure::get_defaults())
                    );
                } else {
                    $measure = Measure::create($this->set_defaults($request->input("measure"), Measure::get_defaults()));
                    $measure->patient_id = $prescription->initial_clinical_history->patient->id;
                    $prescription->measures()->save($measure);
                }
            }

            if($request->has("prescription")) {
                $prescription->prescription = $request->input("prescription");
            }

            $prescription->save();

            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.the_prescription_has_been_updated_correctly")
                ]
            ];

            return redirect()->route("prescription", ["id" => $prescription->id])->with("notify", $notify);
        }

        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_prescription_does_not_exist")
            ]
        ];

        return redirect()->back()->with("notify", $notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prescription  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescription = Prescription::find($id);
        if(!is_null($prescription)) {
            $prescription_folio = $prescription->folio;
            $patient = $prescription->initial_clinical_history->patient->id;
            $prescription->delete();

            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.the_prescription_has_been_removed_correctly")
                ]
            ];
            return redirect()->route('patient', ["id" => $patient])->with("notify", $notify);
        }
        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_prescription_does_not_exist")
            ]
        ];

        return redirect()->back()->with("notify", $notify);
    }

    public function download(Request $request, $id) {
        $doc = $request->query("doc", "prescription");
        if (\View::exists("pdf.$doc")) {
            $prescription = Prescription::find($id);
            if(!is_null($prescription)) {
                $patient = $prescription->initial_clinical_history->patient;
                $pdf_name = str_slug($patient->full_name)."-".str_slug($prescription->folio)."-".date('d-m-Y_h_i_a');
                $pdf = \PDF::loadView("pdf.$doc", [
                    "patient" => $patient,
                    "prescription" => $prescription
                ]);
                //return view("pdf.$doc", ["patient" => $patient, "prescription" => $prescription]);
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
}
