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
            return view("doctor.tracing.new_patient", ["patient" => $patient]);
        }

        return view("doctor.tracing.new_blank");
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

            return redirect()->route("patient", ["id" => $patient->id]);
        }
        /**
         * @TODO Add error message
         */
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $tracing)
    {
        return "TODO: Add this";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function edit(Tracing $tracing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tracing $tracing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tracing  $tracing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tracing $tracing)
    {
        //
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
