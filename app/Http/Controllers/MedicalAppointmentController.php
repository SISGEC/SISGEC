<?php

namespace App\Http\Controllers;

use App\MedicalAppointment;
use Carbon\Carbon;
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
        return redirect()->back();
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

                /**
                 * @TODO add successfull message
                 */
                return redirect()->back();
            }
        }

        /**
         * @TODO Add error message
         */
        return redirect()->back();
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

            return redirect()->back();
        }

        /**
         * @TODO Add error message
         */
        return redirect()->back();
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
