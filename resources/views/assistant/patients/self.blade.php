@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.patient") }} > {{ $patient->full_name }}</h2>
            <div>
                <a href="{{ route("patients.edit", $patient->id) }}" class="btn btn-success">
                    {{ __("global.edit_patient") }}
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-2">
            <div class="nav flex-column nav-pills patient-options" id="patient-options" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">
                    {{ __("global.general") }}
                </a>
                <a class="nav-link" id="studies-tab" data-toggle="pill" href="#studies" role="tab" aria-controls="studies" aria-selected="false">{{ __("global.studies") }}</a>
            </div>
        </div>
        <div class="col-12 col-sm-10">
            <div class="tab-content" id="patient-options-tabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="bgc-white p-20 bd">
                        <h4 class="c-grey-900"><i class="fa fa-chart-line"></i> {{ __("global.statistics") }}</h4>
                        <div class="profile-list-info">
                            <ul>
                                <li title="{{$patient->initial_clinical_history->created_at->diffForHumans()}}">
                                    <strong>{{__('global.first_visit')}}:</strong> {{$patient->initial_clinical_history->created_at->format("d/m/Y")}}
                                </li>
                                <li title="{{$patient->last_update->diffForHumans()}}">
                                    <strong>{{__('global.last_visit')}}:</strong> {{$patient->last_update->format("d/m/Y")}}
                                </li>
                                <li>
                                    <strong>{{__('global.total_visits')}}:</strong> {{$patient->total_visits}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bgc-white p-20 bd mt-3">
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
                                    <strong>{{ __("person.rfc") }}:</strong> {{ $patient->rfc }}
                                </li>
                                <li>
                                    <strong>{{ __("person.phone") }}:</strong> {{ $patient->phone }}
                                </li>
                            </ul>
                        </div>
                    </div>  
                </div>

                <div class="tab-pane fade" id="studies" role="tabpanel" aria-labelledby="studies-tab">
                    <div class="bgc-white p-20 bd d-flex justify-content-between">
                        <h4 class="c-grey-900 mb-0"><i class="fas fa-file-medical"></i> {{ __("global.studies") }}</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudies">
                            {{ __("global.add_studies") }}
                        </button>
                    </div>
                    
                    @php
                        $studies = $patient->initial_clinical_history->studies;
                    @endphp

                    <div class="row mt-3 studies-list">
                        @forelse ($studies as $study)
                            <div class="col-12 col-sm-3 mb-3">
                                <div class="bd bgc-white study study-{{ $study->id }} type-{{ str_slug($study->type) }}" data-tippy="{{$study->original_name}}" data-tippy-arrow="true">
                                    <img src="{{ $study->screenshot }}">
                                    <h3>{{ $study->original_name }}</h3>
                                    <p class="mb-0">{{ $study->type_name }}</p>
                                    <a href="{{ $study->path }}" target="_blank"></a>
                                    <a href="{{ url("/attachments/delete/$study->id") }}" class="btn btn-danger delete-study remove_this"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="bd bgc-white mt-3 p-20">
                                    <div class="layer w-100 banner-message banner-message--error">
                                        <h4 class="mT-10 mB-30">{{ __("error.no_studies") }}</h4>
                                        <i class="ti-face-sad"></i>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addStudies" tabindex="-1" role="dialog" aria-labelledby="addStudiesTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudiesTitle">{{ __("global.add_studies") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("global.close") }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div id="uploadFiles" class="sigec__dropzone" data-patient_id="{{$patient->id.""}}">
                            <div class="dz-message needsclick">    
                                {{ __("global.drop_files_here_or_click_to_upload") }}
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("global.close") }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection