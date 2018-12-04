@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.evolution_note") }} > <a href="{{ route("patient", ["id" => $patient->id]) }}">{{ $patient->name }}</a> > {{ $tracing->name }}</h2>
            <div class="btn-group">
                <a class="btn btn-success" href="{{ route("evolution_note.edit", $tracing->id) }}">{{ __("global.edit_tracing") }}</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">{{ __("global.open_options") }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route("evolution_note.download", ["id" => $tracing->id]) }}">{{ __("global.download") }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger remove_this" href="{{ route("evolution_note.remove", $tracing->id) }}">{{ __("global.remove_tracing") }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h4 class="c-grey-900"><i class="fa fa-user"></i> {{ __("global.identification_card") }}</h4>
                <div class="profile-list-info">
                    <ul>
                        <li>
                            <strong>{{ __("person.name") }}:</strong> {{ $patient->name }}
                        </li>
                        <li>
                            <strong>{{ __("person.lastname") }}:</strong> {{ $patient->lastname }}
                        </li>
                        <li>
                            <strong>{{ __("person.nickname") }}:</strong> {{ $patient->nickname }}
                        </li>
                        <li>
                            <strong>{{ __("person.sex") }}:</strong> {{ $patient->sex === 1 ? __("global.women") : __("global.man") }}
                        </li>
                        <li>
                            <strong>{{ __("person.birthdate") }}:</strong> {{ $patient->birthdate }} ({{ $patient->age . " " . __("person.years") }})
                        </li>
                        <li>
                            <strong>{{ __("person.scholarship") }}:</strong> {{ $patient->scholarship }}
                        </li>
                        <li>
                            <strong>{{ __("person.occupation") }}:</strong> {{ $patient->occupation }}
                        </li>
                        <li>
                            <strong>{{ __("person.religion") }}:</strong> {{ $patient->religion }}
                        </li>
                        <li>
                            <strong>{{ __("person.civil_status") }}:</strong> {{ $patient->civil_status }}
                        </li>
                        <li>
                            <strong>{{ __("person.place_of_birth") }}:</strong> {{ $patient->place_of_birth }}
                        </li>
                        <li>
                            <strong>{{ __("person.place_of_residence") }}:</strong> {{ $patient->place_of_residence }}
                        </li>
                        <li>
                            <strong>{{ __("person.weight") }}:</strong> {{ $patient->measures->weight }}
                        </li>
                        <li>
                            <strong>{{ __("person.height") }}:</strong> {{ $patient->measures->height }}
                        </li>
                        <li>
                            <strong>{{ __("person.temperature") }}:</strong> {{ $patient->measures->temperature }}
                        </li>
                        <li>
                            <strong>{{ __("person.heart_rate") }}:</strong> {{ $patient->measures->heart_rate }}
                        </li>
                        <li>
                            <strong>{{ __("person.blood_pressure") }}:</strong> {{ $patient->measures->blood_pressure }}
                        </li>
                        <li>
                            <strong>{{ __("person.breathing_frequency") }}:</strong> {{ $patient->measures->breathing_frequency }}
                        </li>
                        <li>
                            <strong>{{ __("person.referred_by") }}:</strong> {{ $patient->referred_by }}
                        </li>
                        <li>
                            <strong>{{ __("person.email") }}:</strong> {{ $patient->email }}
                        </li>
                        <li>
                            <strong>{{ __("person.phone") }}:</strong> {{ $patient->phone }}
                        </li>
                    </ul>
                </div>
            </div> 
            
            <div class="bgc-white p-20 bd mt-3">
                <h4 class="c-grey-900"><i class="fas fa-prescription-bottle-alt"></i> {{ __("global.medication") }}</h4>
                {!! $tracing->medication !!}
            </div>

            <div class="bgc-white p-20 bd mt-3">
                <h4 class="c-grey-900"><i class="fas fa-capsules"></i> {{ __("global.treatment_response") }}</h4>
                {!! $tracing->treatment_response !!}
            </div>

            <div class="bgc-white p-20 bd mt-3">
                <h4 class="c-grey-900"><i class="fa fa-stethoscope"></i> {{ __("global.physical_exploration") }}</h4>
                {!! $tracing->physical_exploration !!}
            </div>

            <div class="bgc-white p-20 bd mt-3">
                <h4 class="c-grey-900"><i class="fas fa-notes-medical"></i> {{ __("global.diagnostic") }}</h4>
                {!! $tracing->diagnostic !!}
            </div>

            <div class="bgc-white p-20 bd mt-3">
                <h4 class="c-grey-900"><i class="fas fa-prescription-bottle"></i> {{ __("global.treatment_plan_sub") }}</h4>
                {!! $tracing->treatment_plan_sub !!}
            </div>

            <div class="bgc-white p-20 bd mt-3">
                <div class="profile-list-info">
                    <ul>
                        <li>
                            <strong><i class="fas fa-calendar-alt"></i> {{ __("global.next_appointment_date") }}:</strong> {{ $tracing->next_appointment_date }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection