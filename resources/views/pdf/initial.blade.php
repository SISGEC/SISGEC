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

    <div class="page-break"></div>

    <div class="block  mt-h">
        <h3>{{ __("global.anamnesis") }}</h3>
        <div class="profile-list-description ml-2">
            <ul>
                <li>
                    <strong>{{ __("global.inherit_family") }}:</strong> {{ $patient->initial_clinical_history->anamnesis->inherit_family }}
                </li>
            </ul>
        </div>

        <h4>{{ __("global.not_pathological") }}</h4>
        <div class="columns ml-2">
            <div class="column1">
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
            <div class="column2">
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
    </div> 

    <div class="page-break"></div>

    <div class="block mt-h">
        <h3>{{ __("global.anamnesis") }}</h3>
        <h4 class="mt-1">{{ __("global.pathological_personal") }}</h4>
        <div class="columns ml-2">
            <div class="column1">
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
            <div class="column2">
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
    </div> 

    @if($patient->sex === 1)
        <div class="page-break"></div>
    @endif

    <div class="block {{ $patient->sex === 1 ? "mt-h" : "" }}">
        <h4>{{ __("global.gynecological_obstetric_history") }}</h4>
        <div class="columns ml-2">
            <div class="column1">
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
            <div class="column2">
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

    <div class="page-break"></div>

    <div class="block mt-h">
        <div class="profile-list-description">
            <ul>
                <li>
                    <h3>{{ __("global.current-condition") }}:</h3> {{ $patient->initial_clinical_history->current_condition }}
                </li>
            </ul>
        </div>
    </div>

    <div class="block">
        <h3>{{ __("global.physical-exploration") }}</h3>
        <div class="profile-list-description ml-2">
            <ul>
                <li>
                    <strong>{{ __("global.general_appearance") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->general_appearance }}
                </li>
            </ul>
        </div>

        <div class="profile-list-description ml-2">
            <ul>
                <li>
                    <strong>{{ __("global.head") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->head }}
                </li>
                <li>
                    <strong>{{ __("global.neck") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neck }}
                </li>
                <li>
                    <strong>{{ __("global.chest") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->chest }}
                </li>
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

    <div class="page-break"></div>

    <div class="block mt-h">
        <h3>{{ __("global.physical-exploration") }}</h3>
        <div class="columns ml-2 mt-1">
            <div class="column1">
                <h4>{{ __("global.neurological_examination") }}</h4>
            </div>
            <div class="column2">
                <h4>{{ __("global.orientation") }}</h4>
            </div>
        </div>
        <div class="columns ml-2">
            <div class="column1">
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
            <div class="column2">
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

        <h4>{{ __("global.superior_cognitive_functions") }}</h4>
        <div class="columns ml-2">
            <div class="column1">
                <div class="profile-list-info">
                    <ul>
                        <li>
                            <strong>{{ __("global.abstract") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->abstract === "1" ? __("global.yes") : __("global.no") }}
                        </li>
                        <li>
                            <strong>{{ __("global.concrete") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->concrete === "1" ? __("global.yes") : __("global.no") }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="column2">
                <div class="profile-list-info">
                    <ul>
                        <li>
                            <strong>{{ __("global.literal") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->literal === "1" ? __("global.yes") : __("global.no") }} 
                        </li>
                        <li>
                            <strong>{{ __("global.magical") }}:</strong> {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->magical === "1" ? __("global.yes") : __("global.no") }} 
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="profile-list-description ml-2">
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

    <div class="page-break"></div>

    <div class="block mt-h">
        <h3>{{ __("global.physical-exploration") }}</h3>
        <div class="profile-list-description mt-1">
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

    <div class="page-break"></div>

    <div class="block mt-h">
        <h4 class="c-grey-900"><i class="fas fa-diagnoses"></i> {{ __("global.diagnostical_impression") }}</h4>
        {!! $patient->initial_clinical_history->diagnostical_impression !!}
    </div>

    <div class="block">
        <h4 class="c-grey-900"><i class="fas fa-prescription"></i> {{ __("global.treatment_plan") }}</h4>
        {!! $patient->initial_clinical_history->treatment_plan !!}
    </div>

    <div class="page-break"></div>

    <div class="block mt-h">
        <h4 class="c-grey-900"><i class="fa fa-stethoscope"></i> {{ __("global.interconsultation") }}</h4>
        {!! $patient->initial_clinical_history->interconsultation !!}
    </div>

    <div class="block">
        <h4 class="c-grey-900"><i class="fa fa-prescription-bottle"></i> {{ __("global.treatment") }}</h4>
        {!! $patient->initial_clinical_history->treatment !!}
    </div>

    @php
        $doctor = auth()->user();
    @endphp

    <div class="block signature">
        <h3>{{ __("global.informed_consent") }}</h3>
        <p>{{ __("global.informed_consent_line_1") }}</p>
    </div>
@endsection