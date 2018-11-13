@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.new_patient") }} </h2>
        </div>
    </div>

    <form action="{{ route("patients.new") }}" method="POST">
        @csrf
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">1. {{ __("global.identification_card") }}</h6>
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
                                                    <input class="form-check-input" type="radio" name="sex" id="sexm" checked value="0">
                                                    <label class="form-check-label" for="sexm">{{ __("global.man") }}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sex" id="sexw" value="1">
                                                    <label class="form-check-label" for="sexw">{{ __("global.woman") }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <label for="birthdate">{{ __("person.birthdate") }}</label>
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="dd/mm/yyyy" />
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
                                            <input type="text" class="form-control" id="scholarship" name="scholarship" value="" />
                                        </div>
                                        <div class="col-6">
                                            <label for="occupation">{{ __("person.occupation") }}</label>
                                            <input type="text" class="form-control" id="occupation" name="occupation" value="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="religion">{{ __("person.religion") }}</label>
                                            <input type="text" class="form-control" id="religion" name="religion" value="" />
                                        </div>
                                        <div class="col-6">
                                            <label for="civil_status">{{ __("person.civil_status") }}</label>
                                            <input type="text" class="form-control" id="civil_status" name="civil_status" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="place_of_birth">{{ __("person.place_of_birth") }}</label>
                                            <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="" />
                                        </div>
                                        <div class="col-6">
                                            <label for="place_of_residence">{{ __("person.place_of_residence") }}</label>
                                            <input type="text" class="form-control" id="place_of_residence" name="place_of_residence" value="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="weight">{{ __("person.weight") }}</label>
                                            <input type="text" class="form-control" id="weight" name="weight" value="" />
                                        </div>
                                        <div class="col-4">
                                            <label for="height">{{ __("person.height") }}</label>
                                            <input type="text" class="form-control" id="height" name="height" value="" />
                                        </div>
                                        <div class="col-4">
                                            <label for="temperature">{{ __("person.temperature") }}</label>
                                            <input type="text" class="form-control" id="temperature" name="temperature" value="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="heart_rate">{{ __("person.heart_rate") }}</label>
                                            <input type="text" class="form-control" id="heart_rate" name="heart_rate" value="" />
                                        </div>
                                        <div class="col-4">
                                            <label for="blood_pressure">{{ __("person.blood_pressure") }}</label>
                                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" value="" />
                                        </div>
                                        <div class="col-4">
                                            <label or="breathing_frequency">{{ __("person.breathing_frequency") }}</label>
                                            <input type="text" class="form-control" id="breathing_frequency" name="breathing_frequency" value="" />
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
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">2. {{ __("global.anamnesis") }}</h6>
                    <div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="inherit_family">{{ __("global.inherit_family") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="inherit_family" id="inherit_family" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="c-grey-900"><strong>{{ __("global.not_pathological") }}</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.living_place") }}</label>
                                        <textarea class="form-control" name="living_place" id="living_place" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.personal_hygiene") }}</label>
                                        <textarea class="form-control" name="personal_hygiene" id="personal_hygiene" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.sport_activities") }}</label>
                                        <textarea class="form-control" name="sport_activities" id="sport_activities" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.hobbies") }}</label>
                                        <textarea class="form-control" name="hobbies" id="hobbies" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.immunizations") }}</label>
                                        <textarea class="form-control" name="immunizations" id="immunizations" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.smoking") }}</label>
                                        <textarea class="form-control" name="smoking" id="smoking" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.alcoholism") }}</label>
                                        <textarea class="form-control" name="alcoholism" id="alcoholism" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.drug") }}</label>
                                        <textarea class="form-control" name="drug" id="drug" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.work_activities") }}</label>
                                        <textarea class="form-control" name="work_activities" id="work_activities" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.feeding") }}</label>
                                        <textarea class="form-control" name="feeding" id="feeding" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="c-grey-900"><strong>{{ __("global.pathological_personal") }}</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.childhood_diseases") }}</label>
                                        <textarea class="form-control" name="childhood_diseases" id="childhood_diseases" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.surgical_operations") }}</label>
                                        <textarea class="form-control" name="surgical_operations" id="surgical_operations" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.accidents") }}</label>
                                        <textarea class="form-control" name="accidents" id="accidents" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.traumatic_brain_injury") }}</label>
                                        <textarea class="form-control" name="traumatic_brain_injury" id="traumatic_brain_injury" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.allergies") }}</label>
                                        <textarea class="form-control" name="allergies" id="allergies" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.disabilities") }}</label>
                                        <textarea class="form-control" name="disabilities" id="disabilities" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.blood_transfusions") }}</label>
                                        <textarea class="form-control" name="blood_transfusions" id="blood_transfusions" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="c-grey-900"><strong>{{ __("global.gynecological_obstetric_history") }}</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.ivsa") }}</label>
                                        <textarea class="form-control" name="ivsa" id="ivsa" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.menarca") }}</label>
                                        <textarea class="form-control" name="menarca" id="menarca" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
        
                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.fur") }}</label>
                                        <textarea class="form-control" name="fur" id="fur" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.came") }}</label>
                                        <textarea class="form-control" name="came" id="came" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.pregnancies_number") }}</label>
                                        <textarea class="form-control" name="pregnancies_number" id="pregnancies_number" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.births_number") }}</label>
                                        <textarea class="form-control" name="births_number" id="births_number" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.abortions_number") }}</label>
                                        <textarea class="form-control" name="abortions_number" id="abortions_number" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.ets") }}</label>
                                        <textarea class="form-control" name="ets" id="ets" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.cesareans_number") }}</label>
                                        <textarea class="form-control" name="cesareans_number" id="cesareans_number" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.uma") }}</label>
                                        <textarea class="form-control" name="uma" id="uma" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.other_gyneco_info") }}</label>
                                        <textarea class="form-control" name="other_gyneco_info" id="other_gyneco_info" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.last_papanicolaou_date") }}</label>
                                        <textarea class="form-control" name="last_papanicolaou_date" id="last_papanicolaou_date" cols="30" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="row hide-if-sex-is-male">
                                    <div class="col form-group">
                                        <label class="c-grey-900 pT-10">{{ __("global.last_mammogram_date") }}</label>
                                        <textarea class="form-control" name="last_mammogram_date" id="last_mammogram_date" cols="30" rows="1"></textarea>
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
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">3. {{ __("global.current-condition") }}</h6>
                    <div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <textarea class="form-control" name="current_condition" id="current_condition" cols="30" rows="5"></textarea>
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
                    <h6 class="c-grey-900">3. {{ __("global.physical-exploration") }}</h6>
                    <div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="general_appearance">{{ __("global.general_appearance") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="general_appearance" id="general_appearance" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="head">{{ __("global.head") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="head" id="head" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="neck">{{ __("global.neck") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="neck" id="neck" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="chest">{{ __("global.chest") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="chest" id="chest" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="abdomen">{{ __("global.abdomen") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="abdomen" id="abdomen" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="back">{{ __("global.back") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="back" id="back" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="extremities">{{ __("global.extremities") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="extremities" id="extremities" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="genitals">{{ __("global.genitals") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="genitals" id="genitals" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="c-grey-900"><strong>{{ __("global.neurological_examination") }}</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="mental_examination">{{ __("global.mental_examination") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="mental_examination" id="mental_examination" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="c-grey-900"><strong>{{ __("global.orientation") }}</strong></h6>
                            </div>
                            <div class="col-4">
                                <label for="time">{{ __("global.time") }}</label>
                                <textarea class="form-control" name="time" id="time" cols="30" rows="2"></textarea>
                            </div>
                            <div class="col-4">
                                <label for="space">{{ __("global.space") }}</label>
                                <textarea class="form-control" name="space" id="space" cols="30" rows="2"></textarea>
                            </div>
                            <div class="col-4">
                                <label for="person">{{ __("global.person") }}</label>
                                <textarea class="form-control" name="person" id="person" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="language">{{ __("global.language") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="language" id="language" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="memory">{{ __("global.memory") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="memory" id="memory" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="c-grey-900"><strong>{{ __("global.superior_cognitive_functions") }}</strong></h6>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[abstract]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[abstract]" id="scfa" value="1">
                                        <label class="form-check-label" for="scfa">{{ __('global.abstract') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[concrete]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[concrete]" id="scfc" value="1">
                                        <label class="form-check-label" for="scfc">{{ __('global.concrete') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[literal]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[literal]" id="scfl" value="1">
                                        <label class="form-check-label" for="scfl">{{ __('global.literal') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" style="display:none;" name="superior_cognitive_functions[magical]" value="0">
                                        <input class="form-check-input" type="checkbox" name="superior_cognitive_functions[magical]" id="scfm" value="1">
                                        <label class="form-check-label" for="scfm">{{ __('global.magical') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="arithmetic_calculation">{{ __("global.arithmetic_calculation") }}</label>
                                        <textarea class="form-control" name="arithmetic_calculation" id="arithmetic_calculation" cols="30" rows="2"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="ability_to_draw">{{ __("global.ability_to_draw") }}</label>
                                        <textarea class="form-control" name="ability_to_draw" id="ability_to_draw" cols="30" rows="2"></textarea>
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
                                    <textarea class="form-control" name="hallucinations" id="hallucinations" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="delusions">{{ __("global.delusions") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="delusions" id="delusions" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="esape">{{ __("global.esape") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="esape" id="esape" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="cranial_nerves">{{ __("global.cranial_nerves") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="cranial_nerves" id="cranial_nerves" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="actor_system">{{ __("global.actor_system") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="actor_system" id="actor_system" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="sensitive_system">{{ __("global.sensitive_system") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="sensitive_system" id="sensitive_system" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="sist_vece">{{ __("global.sist_vece") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="sist_vece" id="sist_vece" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="meninges">{{ __("global.meninges") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="meninges" id="meninges" cols="30" rows="4"></textarea>
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
                    <h6 class="c-grey-900">3. {{ __("global.cabinet-studies") }}</h6>
                    <div>
                        <div id="uploadFiles" class="sigec__dropzone">
                            <div class="dz-default dz-message"></div>
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection