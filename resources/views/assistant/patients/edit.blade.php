@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.edit_patient") }} > {{ $patient->full_name }}</h2>
        </div>
    </div>

    <form action="{{ route("patients.update") }}" method="POST" class="inputs-auto-scroll">
        @csrf
        <input type="hidden" name="id" value="{{ $patient->id }}">
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
                                        <input type="text" class="form-control" id="name" name="patient[name]" value="{{ old("name", $patient->name) }}" placeholder="{{ __("person.name") }}" />
                                        <input type="text" class="form-control" id="lastname" name="patient[lastname]" value="{{ old("patient.lastname", $patient->lastname) }}" placeholder="{{ __("person.lastname") }}" />
                                        <input type="text" class="form-control" id="nickname" name="patient[nickname]" value="{{ old("patient.nickname", $patient->nickname) }}" placeholder="{{ __("person.nickname") }}" />
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="birthdate">{{ __("person.sex") }}</label>
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
                                            <label for="birthdate">{{ __("person.birthdate") }}</label>
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="birthdate" name="patient[birthdate]" value="{{ old("patient.birthdate", $patient->birthdate) }}" placeholder="dd/mm/yyyy" />
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
                                            <input type="text" class="form-control" id="scholarship" name="patient[scholarship]" value="{{ old("patient.scholarship", $patient->scholarship) }}" />
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
                                            <label for="civil_status">{{ __("person.civil_status") }}</label>
                                            <input type="text" class="form-control" id="civil_status" name="patient[civil_status]" value="{{ old("patient.civil_status", $patient->civil_status) }}" />
                                        </div>
                                    </div>
                                </div>

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
                            </div>

                            <div class="col-6">
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
                                            <input type="email" class="form-control" id="email" name="patient[email]" value="{{ old("patient.email", $patient->email) }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="phone">{{ __("person.phone") }}</label>
                                            <input type="text" class="form-control" id="phone" name="patient[phone]" value="{{ old("patient.phone", $patient->phone) }}" />
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

        <div class="row sticky-footer">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <div>
                        <div class="row justify-content-center">
                            <a href="{{ route("patient", ["id" => $patient->id]) }}" class="btn btn-danger">{{ __("global.exit") }}</a>
                            <button class="btn btn-success ml-2">{{ __("global.save_patient") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection