<?php

namespace App\Http\Controllers;

use App\MedicalAppointment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class MedicalAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $appointments = MedicalAppointment::whereHas('doctor', function($query) {
            $query->where([
                ["id", "=", doctor()->doctor_id],
                ["date", ">=", Carbon::today()],
                ["date", "<=", Carbon::today()->addDays(30)]
            ]);
        })->orderBy('date', 'asc')->get();
        $now = Carbon::now();
        return view("doctor.appointments.index", compact('appointments', 'now'));
    }

    public function json(Request $request) {
        if($request->has("start") && $request->has("end")) {
            $appointments = MedicalAppointment::whereHas('doctor', function($query) use ($request) {
                $start = $request->query("start", date("Y-m-d"));
                $end = $request->query("end", date("Y-m-d"));
                $query->where([
                    ["id", "=", doctor()->doctor_id],
                    ["date", ">=", Carbon::createFromFormat('Y-m-d', $start)],
                    ["date", "<=", Carbon::createFromFormat('Y-m-d', $end)]
                ]);
            })->get();
        } else {
            $appointments = doctor()->medical_appointments;
        }
        return response()->json($this->to_calendar_format($appointments));
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
        $appointment = new MedicalAppointment;
        $date = $request->input("date", date("d/m/Y h:i a"));
        if($request->has("date")) {
            $date .= " ".$request->input("hour", "08").":".$request->input("minutes", "00")." ".$request->input("a", "am");
        }
        $appointment->title = $request->input("title", "No title");
        $appointment->date = Carbon::createFromFormat('d/m/Y h:i a', $date);
        $appointment->description = $request->input("description", "");
        doctor()->medical_appointments()->save($appointment);

        $notify = [
            [
                "type" => "success",
                "message" => __("global.appointment_scheduled_correctly")
            ]
        ];
        return redirect()->back()->with("notify", $notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicalAppointment  $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $appointment = MedicalAppointment::find($id);
        if(!is_null($appointment)) {
            if($request->ajax()) {
                return response()->json($this->compact($appointment));
            }

            /**
             * @TODO add this
             */
        }

        /**
         * @TODO add error message this
         */

        if($request->ajax()) {
            return response()->json([
            ]);
        }
        return response()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicalAppointment  $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalAppointment $medicalAppointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicalAppointment  $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->has("appointment_id")) {
            $appointment = MedicalAppointment::find($request->input("appointment_id"));
            if(!is_null($appointment)) {
                $date = $request->input("date", date("d/m/Y h:i a"));
                if($request->has("date")) {
                    $date .= " ".$request->input("hour", "08").":".$request->input("minutes", "00")." ".$request->input("a", "am");
                }
                $appointment->title = $request->input("title", $appointment->title);
                $appointment->date = Carbon::createFromFormat('d/m/Y h:i a', $date);
                $appointment->description = $request->input("description", $appointment->description);
                $appointment->save();

                $notify = [
                    [
                        "type" => "success",
                        "message" => __("global.appointment_updated_correctly")
                    ]
                ];
                return redirect()->back()->with("notify", $notify);
            }
        }

        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_appointment_does_not_exist")
            ]
        ];
        return redirect()->back()->with("notify", $notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicalAppointment  $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $appointment = MedicalAppointment::find($id);
        if(!is_null($appointment)) {
            $appointment->delete();

            $notify = [
                [
                    "type" => "success",
                    "message" => __("global.appointment_deleted_correctly")
                ]
            ];
            return redirect()->back()->with("notify", $notify);
        }

        $notify = [
            [
                "type" => "error",
                "message" => __("global.the_selected_appointment_does_not_exist")
            ]
        ];
        return redirect()->back()->with("notify", $notify);
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

    private function get_appointments_treated($lapse) {
        return MedicalAppointment::where([
            ["updated_at", ">=", $lapse->start],
            ["updated_at", "<=", $lapse->end]
        ])->get();
    }

    private function get_appointments_treated_in_date($date) {
        return MedicalAppointment::whereDate('created_at', '=', $date)->get();
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
        if(empty($metric)) $metric = "scheduled_appointments";
        if(empty($lapse)) $metric = "last_week";
        $lapse = $this->get_lapse($lapse);
        $period = $this->get_dates_in_lapse($lapse);
        $appointments = [];
        $total = 0;

        foreach ($period as $date) {
            $appointments[$date] = $this->get_appointments_treated_in_date($date)->count();
            $total += $appointments[$date];
        }

        $response["count"] = count($appointments);
        $response["total"] = $total;
        $response["data"] = $appointments;
        $response["sparkline"] = array_values($appointments);

        return response()->json($response);
    }

    public function compact($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'start' => $item->date->format("c"),
            'end' => $item->date->format("c"),
            'formated_date' => $item->date->format("d/m/Y h:i a"),
            'a' => $item->date->format("a"),
            'date' => $item->date->format("d/m/Y"),
            'h' => $item->date->format("h"),
            'i' => $item->date->format("i"),
            'editable' => false,
            'description' => $item->description,
            'links' => [
                'update' => route("medical_appointments.update"),
                'remove' => route("medical_appointments.remove", ["id" => $item->id])
            ]
        ];
    }

    public function to_calendar_format($items) {
        if(is_null($items)) $items = [];
        $response = [];
        foreach ($items as $item) {
            $response[] = $this->compact($item);
        }
        return $response;
    }
}
