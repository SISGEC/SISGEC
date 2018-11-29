@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.select_an_patient") }}</h2>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="bgc-white p-20 bd">
                @if($patients->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        {{ __("global.no_patients_created") }} <a href="{{ route("patients.new") }}">{{ __("global.please_create_one") }}</a>
                    </div>
                @else
                    <div class="row">
                        <div class="col-4">
                            <p>{{ __("global.select_an_patient_description") }}</p>
                        </div>
                        <div class="col-8">
                            <div class="form-group row">
                                <div class="col">
                                    <select class="custom-select" id="patient_list">
                                        @foreach ($patients as $patient)
                                            <option value="{{ route($route ?? "patient", ["patient_id" => $patient->id]) }}">{{ $patient->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-success" id="patient_list_send">{{ __("global.use_this_patient") }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection