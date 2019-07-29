@extends('layouts.sisgec')

@section('content')

    <div id="onRestoreDataAlert" class="alert alert-warning" style="display:none;" role="alert">
        <h4 class="alert-heading">{{__("global.warning")}}</h4>
        <p>{!!sprintf(__("global.restore_data_alert"), '<a href="'.route("patients.new").'" class="resetDataButton">', '</a>')!!}</p>
    </div>

    <div class="row align-items-center">
        <div class="col-6 text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.new_patient") }} </h2>
        </div>
        <div class="col-6 text-right">
            <h2 class="c-grey-900 mT-10 mB-30">Fecha de elaboración: {{ date("H:m:s d/m/Y") }}</h2>
        </div>
    </div>

    <form action="{{ route("patients.save") }}" method="POST" class="inputs-auto-scroll auto-save-fields">
        @csrf
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <h4 class="c-grey-900">1. {{ __("global.identification_card") }}</h4>
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">{{ __("person.full_name") }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="patient[name]" placeholder="{{ __("person.name") }}" />
                                        <input type="text" class="form-control" id="lastname" name="patient[lastname]" placeholder="{{ __("person.lastname") }}" />
                                        <input type="text" class="form-control" id="nickname" name="patient[nickname]" placeholder="{{ __("person.nickname") }}" />
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="birthdate">{{ __("person.sex") }}</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sex" type="radio" name="patient[sex]" id="sexm" checked value="0">
                                                    <label class="form-check-label" for="sexm">{{ __("global.man") }}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sex" type="radio" name="patient[sex]" id="sexw" value="1">
                                                    <label class="form-check-label" for="sexw">{{ __("global.woman") }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <label for="birthdate">{{ __("person.birthdate") }}</label>
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" class="form-control birthdate" id="birthdate" name="patient[birthdate]" placeholder="dd/mm/yyyy" />
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-control-plaintext" type="text" readonly id="age" tabindex="-1" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="scholarship">{{ __("person.scholarship") }}</label>
                                            <input type="text" name="patient[scholarship]" id="scholarship" class="form-control" value="{{ old("patient.scholarship", "") }}" placeholder="{{ __("global.example_scholarship") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="occupation">{{ __("person.occupation") }}</label>
                                            <input type="text" class="form-control" id="occupation" name="patient[occupation]" value="{{ old("patient.occupation", "") }}" placeholder="{{ __("global.example_occupation") }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="religion">{{ __("person.religion") }}</label>
                                            <input type="text" class="form-control" id="religion" name="patient[religion]" value="{{ old("patient.religion", "") }}" placeholder="{{ __("global.example_religion") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="civil_status">{{ __("person.civil_status") }}</label>
                                            @php
                                                $civil_statuses = is_array(__("civil_status")) ? __("civil_status") : [];
                                            @endphp

                                            <select name="patient[civil_status]" id="civil_status" class="form-control custom-select">
                                                <option value="">{{ __("global.select_an_option") }}</option>
                                                @foreach ($civil_statuses as $civil_status)
                                                    <option value="{{ $civil_status }}"{{ old("patient.civil_status", "") === $civil_status ? " selected" : "" }}>{{ $civil_status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="place_of_birth">{{ __("person.place_of_birth") }}</label>
                                            <input type="text" class="form-control" id="place_of_birth" name="patient[place_of_birth]" value="{{ old("patient.place_of_birth", "") }}" placeholder="{{ __("global.example_place_of_birth") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="place_of_residence">{{ __("person.place_of_residence") }}</label>
                                            <input type="text" class="form-control" id="place_of_residence" name="patient[place_of_residence]" value="{{ old("patient.place_of_residence", "") }}" placeholder="{{ __("global.example_place_of_residence") }}" />
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
                                                <input type="text" class="form-control" autocomplete="off" id="weight" name="measure[weight]" value="{{ old("measure.weight", "") }}" aria-describedby="weight-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="weight-append">kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="height">{{ __("person.height") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="height" name="measure[height]" value="{{ old("measure.height", "") }}" aria-describedby="height-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="height-append">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="temperature">{{ __("person.temperature") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="temperature" name="measure[temperature]" value="{{ old("measure.temperature", "") }}" aria-describedby="temperature-append" />
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
                                                <input type="text" class="form-control" autocomplete="off" id="heart_rate" name="measure[heart_rate]" value="{{ old("measure.heart_rate", "") }}" aria-describedby="heart_rate-append" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="heart_rate-append">BPM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="blood_pressure">{{ __("person.blood_pressure") }}</label>
                                            <input type="text" class="form-control" autocomplete="off" id="blood_pressure" name="measure[blood_pressure]" value="{{ old("measure.blood_pressure", "") }}" />
                                        </div>
                                        <div class="col-4">
                                            <label or="breathing_frequency">{{ __("person.breathing_frequency") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" id="breathing_frequency" name="measure[breathing_frequency]" value="{{ old("measure.breathing_frequency", "") }}" aria-describedby="breathing_frequency-append" />
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
                                            <input type="email" class="form-control" id="email" name="patient[email]" value="{{ old("patient.email", "") }}" placeholder="{{ __("global.example_email") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="phone">{{ __("person.phone") }}</label>
                                            <input type="text" class="form-control" id="phone" name="patient[phone]" value="{{ old("patient.phone", "") }}" placeholder="(123) 456 789" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="rfc">{{ __("person.rfc") }}</label>
                                            <input type="text" class="form-control" id="rfc" name="patient[rfc]" value="{{ old("patient.rfc", "") }}" placeholder="{{ __("global.optional") }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="referred_by">{{ __("person.referred_by") }}</label>
                                            <input type="text" class="form-control" id="referred_by" name="patient[referred_by]" value="{{ old("patient.rfc", "") }}" placeholder="{{ __("global.optional") }}" />
                                        </div>
                                    </div>
                                </div>
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
                            <a href="{{ route("patients") }}" class="btn btn-danger">{{ __("global.exit") }}</a>
                            <button class="btn btn-success ml-2">{{ __("global.save_patient") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade informed_consent_modal" tabindex="-1" role="dialog" aria-labelledby="informed_consent_modal_title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="informed_consent_modal_title">{{ __("global.informed_consent") }}</h5>
                </div>
                <div class="modal-body">
                    {!! __("global.informed_consent_description") !!}
                    <h6>{{ __("global.informed_consent_description_button") }}</h6>
                </div>
                <div class="modal-footer">
                    <a href="{{ route("patients") }}" class="btn btn-danger resetDataButton">{{ __("global.informed_consent_denied_button") }}</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">{{ __("global.informed_consent_accepted_button") }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection