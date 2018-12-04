@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.prescription") }} > <a href="{{ route("patient", ["id" => $prescription->initial_clinical_history->patient->id]) }}">{{ $prescription->initial_clinical_history->patient->full_name }}</a></h2>
            <div class="btn-group">
                <a class="btn btn-success" href="{{ route("prescription.edit", $prescription->id) }}">{{ __("global.edit_prescription") }}</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">{{ __("global.open_options") }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route("prescription.download", ["id" => $prescription->id]) }}">{{ __("global.download") }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger remove_this" href="{{ route("prescription.remove", $prescription->id) }}">{{ __("global.remove_prescription") }}</a>
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
                            <strong>{{ __("global.folio") }}:</strong> #{{ $prescription->folio }}
                        </li>
                        <li>
                            <strong>{{ __("person.name") }}:</strong> {{ $prescription->initial_clinical_history->patient->name }}
                        </li>
                        <li>
                            <strong>{{ __("person.lastname") }}:</strong> {{ $prescription->initial_clinical_history->patient->lastname }}
                        </li>
                        <li>
                            <strong>{{ __("person.sex") }}:</strong> {{ $prescription->initial_clinical_history->patient->sex === 1 ? __("global.women") : __("global.man") }}
                        </li>
                        <li>
                            <strong>{{ __("person.birthdate") }}:</strong> {{ $prescription->initial_clinical_history->patient->birthdate }} ({{ $prescription->initial_clinical_history->patient->age . " " . __("person.years") }})
                        </li>
                        
                        <li>
                            <strong>{{ __("person.weight") }}:</strong> {{ $prescription->initial_clinical_history->patient->measures->weight }}
                        </li>
                        <li>
                            <strong>{{ __("person.height") }}:</strong> {{ $prescription->initial_clinical_history->patient->measures->height }}
                        </li>
                        <li>
                            <strong>{{ __("person.temperature") }}:</strong> {{ $prescription->initial_clinical_history->patient->measures->temperature }}
                        </li>
                        <li>
                            <strong>{{ __("person.heart_rate") }}:</strong> {{ $prescription->initial_clinical_history->patient->measures->heart_rate }}
                        </li>
                        <li>
                            <strong>{{ __("person.blood_pressure") }}:</strong> {{ $prescription->initial_clinical_history->patient->measures->blood_pressure }}
                        </li>
                        <li>
                            <strong>{{ __("person.breathing_frequency") }}:</strong> {{ $prescription->initial_clinical_history->patient->measures->breathing_frequency }}
                        </li>
                        <li>
                            <strong>{{ __("person.email") }}:</strong> {{ $prescription->initial_clinical_history->patient->email }}
                        </li>
                        <li>
                            <strong>{{ __("person.phone") }}:</strong> {{ $prescription->initial_clinical_history->patient->phone }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="bgc-white p-20 bd mt-3">
                <h4 class="c-grey-900"><i class="fas fa-edit"></i> {{ __("global.content") }}</h4>
                <div class="prescripton-content">
                    {!! $prescription->prescription !!}
                </div>
            </div>
        </div>
    </div>
@endsection