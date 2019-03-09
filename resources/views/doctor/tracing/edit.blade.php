@extends('layouts.sisgec')

@section('content')
    <div id="onRestoreDataAlert" class="alert alert-warning" style="display:none;" role="alert">
        <h4 class="alert-heading">{{__("global.warning")}}</h4>
        <p>{!!sprintf(__("global.restore_data_alert"), '<a href="'.route("patients.new").'" class="resetDataButton">', '</a>')!!}</p>
    </div>

    <div class="row align-items-center">
        <div class="col text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.edit_evolution_note") }} > {{ $tracing->name }}</h2>
        </div>
    </div>

    <form action="{{ route("evolution_note.update") }}" method="POST" class="auto-save-fields">
        @csrf
        <input type="hidden" name="tracing_id" value="{{ $tracing->id }}">
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
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
                                                    <input class="form-check-input sex" type="radio" name="patient[sex]" id="sexm" {{ old("patient.sex", $patient->sex) === 1 ? "" : "checked" }} value="0">
                                                    <label class="form-check-label" for="sexm">{{ __("global.man") }}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sex" type="radio" name="patient[sex]" id="sexw" {{ old("patient.sex", $patient->sex) === 1 ? "checked" : "" }} value="1">
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
                                            @php
                                                $scholarships = is_array(__("scholarships")) ? __("scholarships") : [];
                                            @endphp

                                            <select name="patient[scholarship]" id="scholarship" class="form-control custom-select">
                                                <option value="">{{ __("global.select_an_option") }}</option>
                                                @foreach ($scholarships as $scholarship)
                                                    <option value="{{ $scholarship }}"{{ old("patient.scholarship", $patient->scholarship) === $scholarship ? " selected" : "" }}>{{ $scholarship }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="occupation">{{ __("person.occupation") }}</label>
                                            <input type="text" class="form-control" id="occupation" name="patient[occupation]" value="{{ old("patient.occupation", $patient->occupation) }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="religion">{{ __("person.religion") }}</label>
                                            <input type="text" class="form-control" id="religion" name="patient[religion]" value="{{ old("patient.religion", $patient->religion) }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="civil_status">{{ __("person.civil_status") }} <span>*</span></label>
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
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="place_of_birth">{{ __("person.place_of_birth") }}</label>
                                            <input type="text" class="form-control" id="place_of_birth" name="patient[place_of_birth]" value="{{ old("patient.place_of_birth", $patient->place_of_birth) }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="place_of_residence">{{ __("person.place_of_residence") }}</label>
                                            <input type="text" class="form-control" id="place_of_residence" name="patient[place_of_residence]" value="{{ old("patient.place_of_residence", $patient->place_of_residence) }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="weight">{{ __("person.weight") }}</label>
                                            <input type="text" class="form-control" id="weight" name="measure[weight]" value="{{ old("measure.weight", $patient->measures->weight) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label for="height">{{ __("person.height") }}</label>
                                            <input type="text" class="form-control" id="height" name="measure[height]" value="{{ old("measure.height", $patient->measures->height) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label for="temperature">{{ __("person.temperature") }}</label>
                                            <input type="text" class="form-control" id="temperature" name="measure[temperature]" value="{{ old("measure.temperature", $patient->measures->temperature) }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="heart_rate">{{ __("person.heart_rate") }}</label>
                                            <input type="text" class="form-control" id="heart_rate" name="measure[heart_rate]" value="{{ old("measure.heart_rate", $patient->measures->heart_rate) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label for="blood_pressure">{{ __("person.blood_pressure") }}</label>
                                            <input type="text" class="form-control" id="blood_pressure" name="measure[blood_pressure]" value="{{ old("measure.blood_pressure", $patient->measures->blood_pressure) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label or="breathing_frequency">{{ __("person.breathing_frequency") }}</label>
                                            <input type="text" class="form-control" id="breathing_frequency" name="measure[breathing_frequency]" value="{{ old("measure.breathing_frequency", $patient->measures->breathing_frequency) }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email">{{ __("person.email") }}</label>
                                            <input type="email" class="form-control" id="email" name="patient[email]" value="{{ old("patient.email", $patient->email === "-" ? "" : $patient->email) }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="phone">{{ __("person.phone") }} <span>*</span></label>
                                            <input type="text" class="form-control" id="phone" name="patient[phone]" value="{{ old("patient.phone", $patient->phone) }}" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="referred_by">{{ __("person.referred_by") }}</label>
                                            <input type="text" class="form-control" id="referred_by" name="patient[referred_by]" value="{{ old("patient.referred_by", $patient->referred_by) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Inicia bloque --}}
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.medication") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="tracings[medication]" id="medication" cols="30" rows="4">{{ old("tracings.medication", $tracing->medication) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin bloque --}}

        {{-- Inicia bloque --}}
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.treatment_response") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="tracings[treatment_response]" id="treatment_response" cols="30" rows="4">{{ old("tracings.treatment_response", $tracing->treatment_response) }}</textarea>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        {{-- Fin bloque --}}

        {{-- Inicia bloque --}}
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.physical_exploration") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="tracings[physical_exploration]" id="physical_exploration" cols="30" rows="4">{{ old("tracings.physical_exploration", $tracing->physical_exploration) }}</textarea>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        {{-- Fin bloque --}}

        {{-- Bloque estudios --}}
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <h4 class="c-grey-900">{{ __("global.cabinet_studies") }}</h4>
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
        {{-- Fin Bloque estudios --}}

        {{-- Inicia bloque --}}
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.diagnostic") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="tracings[diagnostic]" id="diagnostic" cols="30" rows="4">{{ old("tracings.diagnostic", $tracing->diagnostic) }}</textarea>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        {{-- Fin bloque --}}

        {{-- Inicia bloque --}}
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.treatment_plan_sub") }}</h4>
                    <div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="tracings[treatment_plan_sub]" id="treatment_plan_sub" cols="30" rows="4">{{ old("tracings.treatment_plan_sub", $tracing->treatment_plan_sub) }}</textarea>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        {{-- Fin bloque --}}

        {{-- Inicia bloque --}}
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">{{ __("global.next_appointment_date") }}</h4>
                    <div>
                        <div class="col-8">
                            <label for="next_appointment_date"></label>
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" id="next_appointment_date" data-provide="datepicker" name="tracings[next_appointment_date]" placeholder="dd/mm/yyyy" value="{{ old("tracings.next_appointment_date", $tracing->next_appointment_date) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        {{-- Fin bloque --}}

        <div class="row sticky-footer">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <div>
                        <div class="row justify-content-center">
                            <a href="{{ route("evolution_note", ["id" => $tracing->id]) }}" class="btn btn-danger resetDataButton">{{ __("global.exit") }}</a>
                            <button class="btn btn-success ml-2">{{ __("global.save_tracing") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
