@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.patient") }} > {{ $patient->full_name }}</h2>
            <div>
                <a href="{{ route("patients.edit", $patient->id) }}" class="btn btn-success">
                    {{ __("global.edit_patient") }}
                </a>
                <div class="btn-group">
                    <a href="{{ route("patient.download", ["id" => $patient->id]) }}" class="btn btn-secondary">{{ __("global.download") }}</a>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">{{ __("global.download_options") }}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route("patient.download", ["doc" => "identification_card", "id" => $patient->id]) }}">{{ __("global.download_identification_card") }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-2">
            <div class="nav flex-column nav-pills patient-options" id="patient-options" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">
                    {{ __("global.general") }}
                </a>
                <a class="nav-link" id="tracing-tab" data-toggle="pill" href="#tracing" role="tab" aria-controls="tracing" aria-selected="false">{{ __("global.tracing") }}</a>
                <a class="nav-link" id="prescriptions-tab" data-toggle="pill" href="#prescriptions" role="tab" aria-controls="prescriptions" aria-selected="false">{{ __("global.prescriptions") }}</a>
                <a class="nav-link" id="studies-tab" data-toggle="pill" href="#studies" role="tab" aria-controls="studies" aria-selected="false">{{ __("global.studies") }}</a>
                <a class="nav-link" id="advanced-tab" data-toggle="pill" href="#advanced" role="tab" aria-controls="advanced" aria-selected="false">{{ __("global.advanced") }}</a>
            </div>
        </div>
        <div class="col-12 col-sm-10">
            <div class="tab-content" id="patient-options-tabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="bgc-white p-20 bd">
                        <h4 class="c-grey-900"><i class="fa fa-chart-line"></i> {{ __("global.statistics") }}</h4>
                        <div class="profile-list-info">
                            <ul>
                                <li title="{{$patient->created_at->diffForHumans()}}">
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
                                    <strong>{{ __("person.sex") }}:</strong> {{ $patient->sex == 1 ? __("global.woman") : __("global.man") }}
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

                    <div class="bgc-white p-20 bd mt-3">
                        <h4 class="c-grey-900"><i class="fa fa-address-book"></i> {{ __("global.anamnesis") }}</h4>
                        <div class="profile-list-description">
                            <ul>
                                <li>
                                    <strong>{{ __("global.inherit_family") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->inherit_family }}
                                </li>
                            </ul>
                        </div>

                        <h5 class="c-grey-900 bbt">{{ __("global.not_pathological") }}</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.living_place") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->living_place }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.personal_hygiene") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->personal_hygiene }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.sport_activities") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->sport_activities }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.hobbies") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->hobbies }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.immunizations") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->immunizations }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.smoking") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->smoking }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.alcoholism") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->alcoholism }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.drug") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->drug }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.work_activities") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->work_activities }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.feeding") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->non_pathological->feeding }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <h5 class="c-grey-900 bbt">{{ __("global.pathological_personal") }}</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.childhood_diseases") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->childhood_diseases }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.surgical_operations") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->surgical_operations }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.accidents") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->accidents }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.traumatic_brain_injury") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->traumatic_brain_injury }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.allergies") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->allergies }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.disabilities") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->disabilities }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.blood_transfusions") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->blood_transfusions }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.suicidal_risk") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->pathological_personal->suicidal_risk }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <h5 class="c-grey-900 bbt">{{ __("global.gynecological_obstetric_history") }}</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.ivsa") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->ivsa }}
                                        </li>
                                        @if($patient->sex === 1)
                                            <li>
                                                <strong>{{ __("global.menarca") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->menarca }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.fur") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->fur }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.came") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->came }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.pregnancies_number") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->pregnancies_number }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.births_number") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->births_number }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.abortions_number") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->abortions_number }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.ets") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->ets }}
                                        </li>
                                        @if($patient->sex === 1)
                                            <li>
                                                <strong>{{ __("global.cesareans_number") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->cesareans_number }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.uma") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->uma }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.other_gyneco_info") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->other_gyneco_info }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.last_papanicolaou_date") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->last_papanicolaou_date }}
                                            </li>
                                            <li>
                                                <strong>{{ __("global.last_mammogram_date") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->last_mammogram_date }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="bgc-white p-20 bd mt-3">
                        <h4 class="c-grey-900"><i class="fas fa-heartbeat"></i> {{ __("global.current-condition") }}</h4>
                        {!! $patient->initial_clinical_history->current_condition !!}
                    </div>

                    <div class="bgc-white p-20 bd mt-3">
                        <h4 class="c-grey-900"><i class="fa fa-user-md"></i> {{ __("global.physical-exploration") }}</h4>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.general_appearance") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->general_appearance }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.head") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->head }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.neck") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neck }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.chest") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->chest }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.abdomen") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->abdomen }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.back") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->back }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.extremities") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->extremities }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.genitals") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->genitals }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <h5 class="c-grey-900 bbt">{{ __("global.neurological_examination") }}</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.mental_examination") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->mental_examination }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.language") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->language }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.memory") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->memory }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h6 class="c-grey-900">{{ __("global.orientation") }}</h6>
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.time") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->orientation->time }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.space") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->orientation->space }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.person") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->orientation->person }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <h5 class="c-grey-900 bbt">{{ __("global.superior_cognitive_functions") }}</h5>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h6 class="c-grey-900">{{ __("global.thought") }}</h6>
                                <div class="profile-list-todo">
                                    <ul>
                                        <li>
                                            <i class="fa fa-fw fa-{{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->abstract === "1" ? "check" : "times" }}"></i> <strong>{{ __("global.abstract") }}</strong>
                                        </li>
                                        <li>
                                            <i class="fa fa-fw fa-{{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->concrete === "1" ? "check" : "times" }}"></i> <strong>{{ __("global.concrete") }}</strong>
                                        </li>
                                        <li>
                                            <i class="fa fa-fw fa-{{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->literal === "1" ? "check" : "times" }}"></i> <strong>{{ __("global.literal") }}</strong>
                                        </li>
                                        <li>
                                            <i class="fa fa-fw fa-{{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->magical === "1" ? "check" : "times" }}"></i> <strong>{{ __("global.magical") }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.arithmetic_calculation") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->arithmetic_calculation }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.ability_to_draw") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->ability_to_draw }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.hallucinations") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->hallucinations }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.delusions") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->delusions }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.esape") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->esape }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.cranial_nerves") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->cranial_nerves }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="profile-list-description">
                                    <ul>
                                        <li>
                                            <strong>{{ __("global.actor_system") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->actor_system }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.sensitive_system") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->sensitive_system }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.sist_vece") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->vestibular_system }}
                                        </li>
                                        <li>
                                            <strong>{{ __("global.meninges") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->meninges }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bgc-white p-20 bd mt-3">
                        <h4 class="c-grey-900"><i class="fas fa-diagnoses"></i> {{ __("global.diagnostical_impression") }}</h4>
                        {!! $patient->initial_clinical_history->diagnostical_impression !!}
                    </div>

                    <div class="bgc-white p-20 bd mt-3">
                        <h4 class="c-grey-900"><i class="fas fa-prescription"></i> {{ __("global.treatment_plan") }}</h4>
                        {!! $patient->initial_clinical_history->treatment_plan !!}
                    </div>

                    <div class="bgc-white p-20 bd mt-3">
                        <h4 class="c-grey-900"><i class="fa fa-stethoscope"></i> {{ __("global.interconsultation") }}</h4>
                        {!! $patient->initial_clinical_history->interconsultation !!}
                    </div>

                    <div class="bgc-white p-20 bd mt-3">
                        <h4 class="c-grey-900"><i class="fa fa-prescription-bottle"></i> {{ __("global.treatment") }}</h4>
                        {!! $patient->initial_clinical_history->treatment !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="tracing" role="tabpanel" aria-labelledby="tracing-tab">
                    <div class="bgc-white p-20 bd d-flex justify-content-between">
                        <h4 class="c-grey-900 mb-0"><i class="fas fa-heartbeat"></i> {{ __("global.tracing") }}</h4>
                        <a href="{{ route("evolution_note.new", ["patient" => $patient->id]) }}" class="btn btn-primary">
                            {{ __("global.add_tracing") }}
                        </a>
                    </div>
                    
                    @php
                        $reports = $patient->initial_clinical_history->tracings;
                    @endphp

                    <div class="row mt-3">
                        @forelse ($reports as $report)
                            <div class="col-12 col-sm-3">
                                <div class="bd bgc-white report report-{{ $report->id }}">
                                    <h3>#{{ $report->name }}</h3>
                                    <p>{{ $report->created_at->format(__("global.report_date")) }}</p>
                                    <a href="{{ route("evolution_note", ["id" => $report->id]) }}"></a>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="bd bgc-white mt-3 p-20">
                                    <div class="layer w-100 banner-message banner-message--error">
                                        <h4 class="mT-10 mB-30">{{ __("error.no_tracing_reports") }}</h4>
                                        <i class="ti-face-sad"></i>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="tab-pane fade" id="prescriptions" role="tabpanel" aria-labelledby="prescriptions-tab">
                    <div class="bgc-white p-20 bd d-flex justify-content-between">
                        <h4 class="c-grey-900 mb-0"><i class="fas fa-file-medical"></i> {{ __("global.prescriptions") }}</h4>
                        <a href="{{ route("prescription.new", ["patient_id" => $patient->id]) }}" class="btn btn-primary">
                            {{ __("global.add_prescription") }}
                        </a>
                    </div>
                    
                    @php
                        $prescriptions = $patient->initial_clinical_history->prescriptions;
                    @endphp

                    <div class="row mt-3">
                        @forelse ($prescriptions as $prescription)
                            <div class="col-12 col-sm-3">
                                <div class="bd bgc-white report report-{{ $prescription->id }}">
                                    <h3>Folio #{{ $prescription->folio }}</h3>
                                    <p>{{ $prescription->created_at->format(__("global.report_date")) }}</p>
                                    <a href="{{ route("prescription", ["id" => $prescription->id]) }}"></a>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="bd bgc-white mt-3 p-20">
                                    <div class="layer w-100 banner-message banner-message--error">
                                        <h4 class="mT-10 mB-30">{{ __("error.no_prescriptions") }}</h4>
                                        <i class="ti-face-sad"></i>
                                    </div>
                                </div>
                            </div>
                        @endforelse
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
                            <div class="col-12 no-results-banner">
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

                <div class="tab-pane fade" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">
                    <div class="bgc-white p-20 bd d-flex justify-content-between">
                        <h4 class="c-grey-900 mb-0"><i class="fas fa-cogs"></i> {{ __("global.advanced") }}</h4>
                    </div>

                    <div class="bgc-white p-20 bd mt-3">
                        <div class="remove-container">
                            <h5>{{ __("global.remove-patient") }}</h5>
                            <p>{!! __("global.remove-patient-alet") !!}</p>
                            <a class="btn btn-danger remove_this" href="{{ route("patient.remove", ["id" => $patient->id]) }}">{{ __("global.remove-patient-confirm") }}</a>
                        </div>
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