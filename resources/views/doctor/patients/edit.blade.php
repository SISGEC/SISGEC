@extends('layouts.sisgec')

@section('content')

    <div id="onRestoreDataAlert" class="alert alert-warning" style="display:none;" role="alert">
        <h4 class="alert-heading">{{__("global.warning")}}</h4>
        <p>{!!sprintf(__("global.restore_data_alert"), '<a href="'.route("patients.new").'" class="resetDataButton">', '</a>')!!}</p>
    </div>

    <div class="row align-items-center">
        <div class="col-6 text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.edit_patient") }} > {{ $patient->full_name }}</h2>
        </div>
        <div class="col-6 text-right">
            <h2 class="c-grey-900 mT-10 mB-30">Fecha de elaboración: {{ date("H:m:s d/m/Y") }}</h2>
        </div>
    </div>

    <form action="{{ route("patients.update") }}" method="POST" class="inputs-auto-scroll auto-save-fields">
        @csrf
        <input type="hidden" name="id" value="{{ $patient->id }}">
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.identification_card") }}</h4>
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">{{ __("person.full_name") }} <span>*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="patient[name]" value="{{ old("name", $patient->name) }}" placeholder="{{ __("person.name") }}" required />
                                        <input type="text" class="form-control" id="lastname" name="patient[lastname]" value="{{ old("patient.lastname", $patient->lastname) }}" placeholder="{{ __("person.lastname") }}" required />
                                        <input type="text" class="form-control" id="nickname" name="patient[nickname]" value="{{ old("patient.nickname", $patient->nickname) }}" placeholder="{{ __("person.nickname") }}" />
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="birthdate">{{ __("person.sex") }} <span>*</span></label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sex" type="radio" name="patient[sex]" id="sexm" {{ old("patient.sex", $patient->sex) == 1 ? "" : "checked" }} value="0">
                                                    <label class="form-check-label" for="sexm">{{ __("global.man") }}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sex" type="radio" name="patient[sex]" id="sexw" {{ old("patient.sex", $patient->sex) == 1 ? "checked" : "" }} value="1">
                                                    <label class="form-check-label" for="sexw">{{ __("global.woman") }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <label for="birthdate">{{ __("person.birthdate") }} <span>*</span></label>
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="birthdate" name="patient[birthdate]" value="{{ old("patient.birthdate", $patient->birthdate) }}" placeholder="dd/mm/yyyy" required />
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-control-plaintext" type="text" readonly id="age" tabindex="-1" value="{{ $patient->age." ".__("person.years") }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="scholarship">{{ __("person.scholarship") }}</label>
                                            <input type="text" name="patient[scholarship]" id="scholarship" class="form-control" value="{{ old("patient.scholarship", $patient->scholarship) }}" placeholder="{{ __("global.example_scholarship") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="occupation">{{ __("person.occupation") }}</label>
                                            <input type="text" class="form-control" id="occupation" name="patient[occupation]" value="{{ old("patient.occupation", $patient->occupation) }}" placeholder="{{ __("global.example_occupation") }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="religion">{{ __("person.religion") }}</label>
                                            <input type="text" class="form-control" id="religion" name="patient[religion]" value="{{ old("patient.religion", $patient->religion) }}" placeholder="{{ __("global.example_religion") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="civil_status">{{ __("person.civil_status") }}</label>
                                            @php
                                                $civil_statuses = is_array(__("civil_status")) ? __("civil_status") : [];
                                            @endphp

                                            <select name="patient[civil_status]" id="civil_status" class="form-control custom-select" required>
                                                <option value="">{{ __("global.select_an_option") }}</option>
                                                @foreach ($civil_statuses as $civil_status)
                                                    <option value="{{ $civil_status }}"{{ old("patient.civil_status", $patient->civil_status) === $civil_status ? " selected" : "" }}>{{ $civil_status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="place_of_birth">{{ __("person.place_of_birth") }}</label>
                                            <input type="text" class="form-control" id="place_of_birth" name="patient[place_of_birth]" value="{{ old("patient.place_of_birth", $patient->place_of_birth) }}" placeholder="{{ __("global.example_place_of_birth") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="place_of_residence">{{ __("person.place_of_residence") }}</label>
                                            <input type="text" class="form-control" id="place_of_residence" name="patient[place_of_residence]" value="{{ old("patient.place_of_residence", $patient->place_of_residence) }}" placeholder="{{ __("global.example_place_of_residence") }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="weight">{{ __("person.weight") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="weight" name="measure[weight]" value="{{ old("measure.weight", $patient->measures->weight) }}" aria-describedby="weight-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="weight-append">kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="height">{{ __("person.height") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="height" name="measure[height]" value="{{ old("measure.height", $patient->measures->height) }}" aria-describedby="height-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="height-append">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="temperature">{{ __("person.temperature") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="temperature" name="measure[temperature]" value="{{ old("measure.temperature", $patient->measures->temperature) }}" aria-describedby="temperature-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="temperature-append">ºC</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="heart_rate">{{ __("person.heart_rate") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="heart_rate" name="measure[heart_rate]" value="{{ old("measure.heart_rate", $patient->measures->heart_rate) }}" aria-describedby="heart_rate-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="heart_rate-append">BPM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="blood_pressure">{{ __("person.blood_pressure") }}</label>
                                            <input type="text" class="form-control" autocomplete="off" id="blood_pressure" name="measure[blood_pressure]" value="{{ old("measure.blood_pressure", $patient->measures->blood_pressure) }}" placeholder="000/00" />
                                        </div>
                                        <div class="col-4">
                                            <label or="breathing_frequency">{{ __("person.breathing_frequency") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="breathing_frequency" name="measure[breathing_frequency]" value="{{ old("measure.breathing_frequency", $patient->measures->breathing_frequency) }}" aria-describedby="breathing_frequency-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="breathing_frequency-append">RPM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email">{{ __("person.email") }}</label>
                                            <input type="email" class="form-control" id="email" name="patient[email]" value="{{ old("patient.email", ($patient->email === "-" ? "" : $patient->email)) }}" placeholder="{{ __("global.example_email") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="phone">{{ __("person.phone") }}</label>
                                            <input type="text" class="form-control" id="phone" name="patient[phone]" value="{{ old("patient.phone", $patient->phone) }}" placeholder="(123) 456 789" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="rfc">{{ __("person.rfc") }}</label>
                                            <input type="text" class="form-control" id="rfc" name="patient[rfc]" value="{{ old("patient.rfc", $patient->rfc) }}" placeholder="{{ __("global.optional") }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="referred_by">{{ __("person.referred_by") }}</label>
                                            <input type="text" class="form-control" id="referred_by" name="patient[referred_by]" value="{{ old("patient.referred_by", $patient->referred_by) }}" placeholder="{{ __("global.example_referred_by") }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.anamnesis") }}</h4>
                    <div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="inherit_family">{{ __("global.inherit_family") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="inherit_family" id="inherit_family" cols="30" rows="5">{{ old("inherit_family", $patient->initial_clinical_history->anamnesis->inherit_family) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 class="c-grey-900">{{ __("global.not_pathological") }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.living_place") }}</label>
                                        <textarea class="form-control" name="non_pathological[living_place]" id="living_place" cols="30" rows="1">{{ old("non_pathological.living_place", $patient->initial_clinical_history->anamnesis->non_pathological->living_place) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.personal_hygiene") }}</label>
                                        <textarea class="form-control" name="non_pathological[personal_hygiene]" id="personal_hygiene" cols="30" rows="1">{{ old("non_pathological.personal_hygiene", $patient->initial_clinical_history->anamnesis->non_pathological->personal_hygiene) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.sport_activities") }}</label>
                                        <textarea class="form-control" name="non_pathological[sport_activities]" id="sport_activities" cols="30" rows="1">{{ old("non_pathological.sport_activities", $patient->initial_clinical_history->anamnesis->non_pathological->sport_activities) }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.hobbies") }}</label>
                                        <textarea class="form-control" name="non_pathological[hobbies]" id="hobbies" cols="30" rows="1">{{ old("non_pathological.hobbies", $patient->initial_clinical_history->anamnesis->non_pathological->hobbies) }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.immunizations") }}</label>
                                        <textarea class="form-control" name="non_pathological[immunizations]" id="immunizations" cols="30" rows="1">{{ old("non_pathological.immunizations", $patient->initial_clinical_history->anamnesis->non_pathological->immunizations) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.smoking") }}</label>
                                        <textarea class="form-control" name="non_pathological[smoking]" id="smoking" cols="30" rows="1">{{ old("non_pathological.smoking", $patient->initial_clinical_history->anamnesis->non_pathological->smoking) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.alcoholism") }}</label>
                                        <textarea class="form-control" name="non_pathological[alcoholism]" id="alcoholism" cols="30" rows="1">{{ old("non_pathological.alcoholism", $patient->initial_clinical_history->anamnesis->non_pathological->alcoholism) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.drug") }}</label>
                                        <textarea class="form-control" name="non_pathological[drug]" id="drug" cols="30" rows="1">{{ old("non_pathological.drug", $patient->initial_clinical_history->anamnesis->non_pathological->drug) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.work_activities") }}</label>
                                        <textarea class="form-control" name="non_pathological[work_activities]" id="work_activities" cols="30" rows="1">{{ old("non_pathological.work_activities", $patient->initial_clinical_history->anamnesis->non_pathological->work_activities) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.feeding") }}</label>
                                        <textarea class="form-control" name="non_pathological[feeding]" id="feeding" cols="30" rows="1">{{ old("non_pathological.feeding", $patient->initial_clinical_history->anamnesis->non_pathological->feeding) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 class="c-grey-900">{{ __("global.pathological_personal") }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.childhood_diseases") }}</label>
                                        <textarea class="form-control" name="pathological[childhood_diseases]" id="childhood_diseases" cols="30" rows="1">{{ old("pathological.childhood_diseases", $patient->initial_clinical_history->anamnesis->pathological_personal->childhood_diseases) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.surgical_operations") }}</label>
                                        <textarea class="form-control" name="pathological[surgical_operations]" id="surgical_operations" cols="30" rows="1">{{ old("pathological.surgical_operations", $patient->initial_clinical_history->anamnesis->pathological_personal->surgical_operations) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.accidents") }}</label>
                                        <textarea class="form-control" name="pathological[accidents]" id="accidents" cols="30" rows="1">{{ old("pathological.accidents", $patient->initial_clinical_history->anamnesis->pathological_personal->accidents) }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.traumatic_brain_injury") }}</label>
                                        <textarea class="form-control" name="pathological[traumatic_brain_injury]" id="traumatic_brain_injury" cols="30" rows="1">{{ old("pathological.traumatic_brain_injury", $patient->initial_clinical_history->anamnesis->pathological_personal->traumatic_brain_injury) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.allergies") }}</label>
                                        <textarea class="form-control" name="pathological[allergies]" id="allergies" cols="30" rows="1">{{ old("pathological.allergies", $patient->initial_clinical_history->anamnesis->pathological_personal->allergies) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.disabilities") }}</label>
                                        <textarea class="form-control" name="pathological[disabilities]" id="disabilities" cols="30" rows="1">{{ old("pathological.disabilities", $patient->initial_clinical_history->anamnesis->pathological_personal->disabilities) }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.blood_transfusions") }}</label>
                                        <textarea class="form-control" name="pathological[blood_transfusions]" id="blood_transfusions" cols="30" rows="1">{{ old("pathological.blood_transfusions", $patient->initial_clinical_history->anamnesis->pathological_personal->blood_transfusions) }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.suicidal_risk") }}</label>
                                        <textarea class="form-control" name="pathological[suicidal_risk]" id="suicidal_risk" cols="30" rows="1">{{ old("pathological.suicidal_risk", $patient->initial_clinical_history->anamnesis->pathological_personal->suicidal_risk) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 class="c-grey-900">{{ __("global.gynecological_obstetric_history") }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.ivsa") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[ivsa]" id="ivsa" cols="30" rows="1">{{ old("gyneco_obstetrics.blood_transfusions", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->ivsa) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.menarca") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[menarca]" id="menarca" cols="30" rows="1">{{ old("gyneco_obstetrics.blood_transfusions", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->menarca) }}</textarea>
                                    </div>
                                </div>
        
                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.fur") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[fur]" id="fur" cols="30" rows="1">{{ old("gyneco_obstetrics.fur", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->fur) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.came") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[came]" id="came" cols="30" rows="1">{{ old("gyneco_obstetrics.came", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->came) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.pregnancies_number") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[pregnancies_number]" id="pregnancies_number" cols="30" rows="1">{{ old("gyneco_obstetrics.pregnancies_number", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->pregnancies_number) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.births_number") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[births_number]" id="births_number" cols="30" rows="1">{{ old("gyneco_obstetrics.births_number", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->births_number) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.abortions_number") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[abortions_number]" id="abortions_number" cols="30" rows="1">{{ old("gyneco_obstetrics.abortions_number", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->abortions_number) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.ets") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[ets]" id="ets" cols="30" rows="1">{{ old("gyneco_obstetrics.ets", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->ets) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.cesareans_number") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[cesareans_number]" id="cesareans_number" cols="30" rows="1">{{ old("gyneco_obstetrics.cesareans_number", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->cesareans_number) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.uma") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[uma]" id="uma" cols="30" rows="1">{{ old("gyneco_obstetrics.uma", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->uma) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.other_gyneco_info") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[other_gyneco_info]" id="other_gyneco_info" cols="30" rows="1">{{ old("gyneco_obstetrics.other_gyneco_info", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->other_gyneco_info) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.last_papanicolaou_date") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[last_papanicolaou_date]" id="last_papanicolaou_date" cols="30" rows="1">{{ old("gyneco_obstetrics.last_papanicolaou_date", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->last_papanicolaou_date) }}</textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.last_mammogram_date") }}</label>
                                        <textarea class="form-control" name="gyneco_obstetrics[last_mammogram_date]" id="last_mammogram_date" cols="30" rows="1">{{ old("gyneco_obstetrics.last_mammogram_date", $patient->initial_clinical_history->anamnesis->gynecological_obstetric_history->last_mammogram_date) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.current-condition") }}</h4>
                    <div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <textarea class="form-control" name="initial_clinical_history[current_condition]" id="current_condition" cols="30" rows="5">{{ old("initial_clinical_history.current_condition", $patient->initial_clinical_history->current_condition) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.physical-exploration") }}</h4>
                    <div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="general_appearance">{{ __("global.general_appearance") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[general_appearance]" id="general_appearance" cols="30" rows="5">{{ old("physical_exploration.general_appearance", $patient->initial_clinical_history->physical_exploration->general_appearance) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="head">{{ __("global.head") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[head]" id="head" cols="30" rows="5">{{ old("physical_exploration.head", $patient->initial_clinical_history->physical_exploration->head) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="neck">{{ __("global.neck") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[neck]" id="neck" cols="30" rows="5">{{ old("physical_exploration.neck", $patient->initial_clinical_history->physical_exploration->neck) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="chest">{{ __("global.chest") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[chest]" id="chest" cols="30" rows="5">{{ old("physical_exploration.chest", $patient->initial_clinical_history->physical_exploration->chest) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="abdomen">{{ __("global.abdomen") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[abdomen]" id="abdomen" cols="30" rows="5">{{ old("physical_exploration.abdomen", $patient->initial_clinical_history->physical_exploration->abdomen) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="back">{{ __("global.back") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[back]" id="back" cols="30" rows="5">{{ old("physical_exploration.back", $patient->initial_clinical_history->physical_exploration->back) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="extremities">{{ __("global.extremities") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[extremities]" id="extremities" cols="30" rows="5">{{ old("physical_exploration.extremities", $patient->initial_clinical_history->physical_exploration->extremities) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="genitals">{{ __("global.genitals") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="physical_exploration[genitals]" id="genitals" cols="30" rows="5">{{ old("physical_exploration.genitals", $patient->initial_clinical_history->physical_exploration->genitals) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 class="c-grey-900">{{ __("global.neurological_examination") }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="mental_examination">{{ __("global.mental_examination") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[mental_examination]" id="mental_examination" cols="30" rows="5">{{ old("neuro_exam.mental_examination", $patient->initial_clinical_history->physical_exploration->neurological_examination->mental_examination) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="c-grey-900">{{ __("global.orientation") }}</h5>
                            </div>
                            <div class="col-4">
                                <label for="time">{{ __("global.time") }}</label>
                                <textarea class="form-control" name="orientation[time]" id="time" cols="30" rows="2">{{ old("orientation.time", $patient->initial_clinical_history->physical_exploration->neurological_examination->orientation->time) }}</textarea>
                            </div>
                            <div class="col-4">
                                <label for="space">{{ __("global.space") }}</label>
                                <textarea class="form-control" name="orientation[space]" id="space" cols="30" rows="2">{{ old("orientation.space", $patient->initial_clinical_history->physical_exploration->neurological_examination->orientation->space) }}</textarea>
                            </div>
                            <div class="col-4">
                                <label for="person">{{ __("global.person") }}</label>
                                <textarea class="form-control" name="orientation[person]" id="person" cols="30" rows="2">{{ old("orientation.person", $patient->initial_clinical_history->physical_exploration->neurological_examination->orientation->person) }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="language">{{ __("global.language") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[language]" id="language" cols="30" rows="5">{{ old("neuro_exam.language", $patient->initial_clinical_history->physical_exploration->neurological_examination->language) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="memory">{{ __("global.memory") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[memory]" id="memory" cols="30" rows="4">{{ old("neuro_exam.memory", $patient->initial_clinical_history->physical_exploration->neurological_examination->memory) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 class="c-grey-900">{{ __("global.superior_cognitive_functions") }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[abstract]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[abstract]" id="scfa" {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->abstract === "1" ? "checked" : "" }} value="1">
                                        <label class="form-check-label" for="scfa">{{ __('global.abstract') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[concrete]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[concrete]" id="scfc" {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->concrete === "1" ? "checked" : "" }} value="1">
                                        <label class="form-check-label" for="scfc">{{ __('global.concrete') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[literal]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[literal]" id="scfl" {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->literal === "1" ? "checked" : "" }} value="1">
                                        <label class="form-check-label" for="scfl">{{ __('global.literal') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[magical]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[magical]" id="scfm" {{ $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->magical === "1" ? "checked" : "" }} value="1">
                                        <label class="form-check-label" for="scfm">{{ __('global.magical') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="arithmetic_calculation">{{ __("global.arithmetic_calculation") }}</label>
                                        <textarea class="form-control" name="superior_cognitive_functions[arithmetic_calculation]" id="arithmetic_calculation" cols="30" rows="2">{{ old("superior_cognitive_functions.arithmetic_calculation", $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->arithmetic_calculation) }}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="ability_to_draw">{{ __("global.ability_to_draw") }}</label>
                                        <textarea class="form-control" name="superior_cognitive_functions[ability_to_draw]" id="ability_to_draw" cols="30" rows="2">{{ old("superior_cognitive_functions.ability_to_draw", $patient->initial_clinical_history->physical_exploration->neurological_examination->superior_cognitive_functions->ability_to_draw) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="hallucinations">{{ __("global.hallucinations") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[hallucinations]" id="hallucinations" cols="30" rows="4">{{ old("neuro_exam.hallucinations", $patient->initial_clinical_history->physical_exploration->neurological_examination->hallucinations) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="delusions">{{ __("global.delusions") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[delusions]" id="delusions" cols="30" rows="4">{{ old("neuro_exam.delusions", $patient->initial_clinical_history->physical_exploration->neurological_examination->delusions) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="esape">{{ __("global.esape") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[esape]" id="esape" cols="30" rows="4">{{ old("neuro_exam.esape", $patient->initial_clinical_history->physical_exploration->neurological_examination->esape) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="cranial_nerves">{{ __("global.cranial_nerves") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[cranial_nerves]" id="cranial_nerves" cols="30" rows="4">{{ old("neuro_exam.cranial_nerves", $patient->initial_clinical_history->physical_exploration->neurological_examination->cranial_nerves) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="actor_system">{{ __("global.actor_system") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[actor_system]" id="actor_system" cols="30" rows="4">{{ old("neuro_exam.actor_system", $patient->initial_clinical_history->physical_exploration->neurological_examination->actor_system) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="sensitive_system">{{ __("global.sensitive_system") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[sensitive_system]" id="sensitive_system" cols="30" rows="4">{{ old("neuro_exam.sensitive_system", $patient->initial_clinical_history->physical_exploration->neurological_examination->sensitive_system) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="sist_vece">{{ __("global.sist_vece") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[vestibular_system]" id="vestibular_system" cols="30" rows="4">{{ old("neuro_exam.vestibular_system", $patient->initial_clinical_history->physical_exploration->neurological_examination->vestibular_system) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="meninges">{{ __("global.meninges") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neuro_exam[meninges]" id="meninges" cols="30" rows="4">{{ old("neuro_exam.meninges", $patient->initial_clinical_history->physical_exploration->neurological_examination->meninges) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <h4 class="c-grey-900">{{ __("global.cabinet_studies") }}</h4>

                    <div class="studies-loaded">
                        @php
                            $studies = $patient->initial_clinical_history->studies;
                        @endphp
                        
                    </div>

                    <div>
                        <div id="uploadFiles" class="sigec__dropzone">
                            <div class="dz-message needsclick">    
                                {{ __("global.drop_files_here_or_click_to_upload") }}
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </div>
                        <div id="studies"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.diagnostical_impression") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="initial_clinical_history[diagnostical_impression]" id="diagnostical_impression" cols="30" rows="4">{{ old("initial_clinical_history.diagnostical_impression", $patient->initial_clinical_history->diagnostical_impression) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.treatment_plan") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="initial_clinical_history[treatment_plan]" id="treatment_plan" cols="30" rows="4">{{ old("initial_clinical_history.treatment_plan", $patient->initial_clinical_history->treatment_plan) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.interconsultation") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="initial_clinical_history[interconsultation]" id="interconsultation" cols="30" rows="4">{{ old("initial_clinical_history.interconsultation", $patient->initial_clinical_history->interconsultation) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.treatment") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="initial_clinical_history[treatment]" id="treatment" cols="30" rows="4">{{ old("initial_clinical_history.treatment", $patient->initial_clinical_history->treatment) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row sticky-footer">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <div>
                        <div class="row justify-content-center">
                            <a href="{{ route("patient", ["id" => $patient->id]) }}" class="btn btn-danger resetDataButton">{{ __("global.exit") }}</a>
                            <button class="btn btn-success ml-2">{{ __("global.save_patient") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
