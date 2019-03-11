@extends('pdf.layouts.sisgec')

@section('content')
    <div class="columns mt-h">
        <div class="column1 mw-100">
            <h1>{{ __("global.initial_clinical_history") }}</h1>
        </div>
    </div>

    <div class="block">
        <div class="columns">
            <div class="column1">
                <div class="profile-list-info">
                    <ul>
                        <li>
                            <strong>{{ __("global.creation_date") }}</strong> {{ $patient->initial_clinical_history->created_at->format("d/m/Y h:i a") }}
                        </li>
                        <li>
                            <strong>{{ __("global.updated_date") }}</strong> {{ $patient->last_update->format("d/m/Y h:i a") }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="column2">
                <div class="profile-list-info">
                    <ul>
                        <li>
                            <strong>{{ __("global.folio") }}</strong> <span class="bold red mt-1">#{{ $patient->initial_clinical_history->folio }}</span>
                        </li>
                        <li>
                            <strong>{{ __("global.printing_date") }}</strong> {{ date('d/m/Y h:i a') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <h3>{{ __("global.identification_card") }}</h3>
        <div class="columns">
            <div class="column1">
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
                            <strong>{{ __("person.sex") }}:</strong> {{ $patient->sex == 1 ? __("global.woman") : __("global.man") }}
                        </li>
                        <li>
                            <strong>{{ __("person.birthdate") }}:</strong> {{ $patient->birthdate }}
                        </li>
                        <li>
                            <strong>{{ __("person.age") }}:</strong> {{ $patient->age . " " . __("person.years") }}
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
                    </ul>
                </div>
            </div>
            <div class="column2">
                <div class="profile-list-info">
                <ul>
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
                        <strong>{{ __("person.rfc") }}:</strong> {{ $patient->rfc }}
                    </li>
                    <li>
                        <strong>{{ __("person.phone") }}:</strong> {{ $patient->phone }}
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </div>
@endsection