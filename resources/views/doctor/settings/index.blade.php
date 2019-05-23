@extends('layouts.sisgec')

@section('content')
    <div class="row">
        <div class="col">
            <h2 class="c-grey-900 mT-10 mB-30"><i class="fas fa-sliders-h"></i> {{ __("global.settings") }}</h2>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="nav flex-column nav-pills user-options" id="user-options" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                    {{ __("global.perfil") }}
                </a>
                <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">
                    {{ __("global.security") }}
                </a>
                <a class="nav-link" id="system-tab" data-toggle="pill" href="#system" role="tab" aria-controls="system" aria-selected="false">{{ __("global.system_label") }}</a>
                <a class="nav-link" id="devices-tab" data-toggle="pill" href="#devices" role="tab" aria-controls="devices" aria-selected="false">Dispositivos</a>
                {{--<a class="nav-link" id="advanced-tab" data-toggle="pill" href="#advanced" role="tab" aria-controls="advanced" aria-selected="false">{{ __("global.advanced") }}</a>--}}
            </div>
        </div>
        <div class="col-12 col-sm-9">
            <div class="tab-content" id="user-options-tabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="bgc-white p-20 bd">    
                        <div class="block">
                            <form action="{{ route("doctor.update") }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{doctor()->id}}">
                                <input type="hidden" name="doctor_id" value="{{ doctor()->doctor_id }}">
                                <div class="row">
                                    <div class="col-3 order-1 order-md-2 text-right">
                                        <button type="button" class="btn btn-primary edit_block" data-tippy="{{ __("global.edit_settings") }}" data-tippy-arrow="true" data-tippy-placement="left"><i class="fas fa-w fa-edit"></i></button>
                                        <button type="submit" class="btn btn-success save_block d-none" data-tippy="{{ __("global.save_settings") }}" data-tippy-arrow="true" data-tippy-placement="left"><i class="fas fa-w fa-save"></i></button>
                                    </div>
                                    <div class="col-9">
                                        <h4 class="c-grey-900"><i class="fas fa-w fa-user"></i> {{ __("global.general_info") }}</h4>
                                    </div>
                                </div>
                        
                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_name">{{ __("person.name") }}</label>
                                            <input type="text" class="form-control-plaintext" id="user_name" name="user[name]" value="{{ old("user.name", doctor()->name) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_lastname">{{ __("person.lastname") }}</label>
                                            <input type="text" class="form-control-plaintext" id="user_lastname" name="user[lastname]" value="{{ old("user.lastname", doctor()->lastname) }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_email">{{ __("person.email") }}</label>
                                            <input type="email" class="form-control-plaintext" id="user_email" name="user[email]" value="{{ old("user.email", doctor()->email) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_title">{{ __("person.title") }}</label>
                                            <input type="text" class="form-control-plaintext" id="user_title" name="user[title]" value="{{ old("user.email", doctor()->title) }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_phone">{{ __("person.phone") }}</label>
                                            <input id="phone" type="text" class="form-control-plaintext" id="user_phone" name="user[phone]" value="{{ old("user.phone", doctor()->phone) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (doctor()->is_doctor())
                        <div class="bgc-white p-20 bd mt-3">    
                            <div class="block">
                                <form action="{{ route("doctor.update") }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{doctor()->id}}">
                                    <input type="hidden" name="doctor_id" value="{{ doctor()->doctor_id }}">
                                    <div class="row">
                                        <div class="col-3 order-1 order-md-2 text-right">
                                            <button type="button" class="btn btn-primary edit_block" data-tippy="{{ __("global.edit_settings") }}" data-tippy-arrow="true" data-tippy-placement="left"><i class="fas fa-w fa-edit"></i></button>
                                            <button type="submit" class="btn btn-success save_block d-none" data-tippy="{{ __("global.edit_settings") }}" data-tippy-arrow="true" data-tippy-placement="left"><i class="fas fa-w fa-save"></i></button>
                                        </div>
                                        <div class="col-9">
                                            <h4 class="c-grey-900"><i class="fas fa-w fa-user-md"></i> {{ __("global.medical_information") }}</h4>
                                        </div>
                                    </div>
                            
                                    <div class="form-row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="doctor_specialty">{{ __("person.specialty") }}</label>
                                                <input type="text" class="form-control-plaintext" id="doctor_specialty" name="doctor[specialty]" value="{{ old("doctor.specialty", doctor()->specialty) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="doctor_university">{{ __("person.university") }}</label>
                                                <input type="text" class="form-control-plaintext" id="doctor_university" name="doctor[university]" value="{{ old("doctor.university", doctor()->university) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="form-row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="doctor_professional_license">{{ __("global.professional_license") }}</label>
                                                <input type="text" class="form-control-plaintext" id="doctor_professional_license" name="doctor[professional_license]" value="{{ old("doctor.professional_license", doctor()->professional_license) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <div class="bgc-white p-20 bd">
                        <div class="block">
                            <form action="{{ route("doctor.update") }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{doctor()->id}}">
                                <input type="hidden" name="doctor_id" value="{{ doctor()->doctor_id }}">
                                <div class="row">
                                    <div class="col-9">
                                        <h4 class="c-grey-900"><i class="fas fa-w fa-shield-alt"></i> {{ __("global.security") }}</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-info" role="alert">
                                            <p>{{ __("global.change_password_info") }}</p>
                                            @php
                                                $password_recommendations = __("passwords.recommendations");
                                                if(!is_array($password_recommendations)) $password_recommendations = [];
                                            @endphp
                                            @if (count($password_recommendations) > 0)
                                                <ul>
                                                    @foreach ($password_recommendations as $recommendation)
                                                        <li>{!! $recommendation !!}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_new_password">{{ __("global.new_password") }}</label>
                                            <input type="password" class="form-control" id="user_new_password" name="password[new]" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_password_confirm">{{ __("global.repeat_password") }}</label>
                                            <input type="password" class="form-control" id="user_password_confirm" name="password[confirm]" placeholder="" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary chage_password_button" disabled>{{ __("global.change_password") }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="system" role="tabpanel" aria-labelledby="system-tab">
                    <div class="bgc-white p-20 bd">
                        <div class="block">
                            <form action="{{ route("options.save") }}" enctype="multipart/form-data" method="POST" >
                                @csrf
                                <div class="row">
                                    <div class="col-9">
                                        <h4 class="c-grey-900"><i class="fas fa-w fa-filter"></i> {{ __("global.system_label") }}</h4>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="option_sitename">{{ __("global.sitename") }}</label>
                                            <input type="text" class="form-control" id="option_sitename" name="options[name]" value="{{ old("options.name", config("app.name")) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="option_lang">{{ __("global.language") }}</label>
                                            <select class="form-control custom-control" name="options[lang]" id="option_lang">
                                                <option value="es"{{(old("options.lang", app()->getLocale()) === "es" ? " selected" : "")}}>Español</option>
                                                <option value="en"{{(old("options.lang", app()->getLocale()) === "en" ? " selected" : "")}}>Ingles</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="option_office_address">{{ __("global.office_address") }}</label>
                                            <textarea class="form-control" name="options[office_address]" id="option_office_address" cols="30" rows="1">{{ old("options.office_address", config("app.office_address")) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="phone2">{{ __("global.office_phone") }}</label>
                                            <input type="text" class="form-control" id="phone2" name="options[office_phone]" value="{{ old("options.office_phone", config("app.office_phone")) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="option_office_logo">{{ __("global.office_logo") }}</label>
                                            <div class="row">
                                                <div class="col-12 mb-3 text-center">
                                                    <div class="preview_pic">
                                                        <img id="option_office_logo_preview" src="{{ config("app.office_logo", asset("images/sisgec-logo.png")) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="options[office_logo]" id="option_office_logo" accept="image/*">
                                                        <label class="custom-file-label" for="option_office_logo">{{ __("global.choose_file") }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="option_office_brand">{{ __("global.office_brand") }}</label>
                                            <div class="row">
                                                <div class="col-12 mb-3 text-center">
                                                    <div class="preview_pic">
                                                        <img id="option_office_brand_preview" src="{{ config("app.office_brand", asset("images/sisgec-brand.png")) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="options[office_brand]" id="option_office_brand" accept="image/*">
                                                        <label class="custom-file-label" for="option_office_brand">{{ __("global.choose_file") }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">{{ __("global.save_options") }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="devices" role="tabpanel" aria-labelledby="devices-tab">
                    <div class="bgc-white p-20 bd">    
                        <div class="block">
                            <form action="{{ route("doctor.update") }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{doctor()->id}}">
                                <input type="hidden" name="doctor_id" value="{{ doctor()->doctor_id }}">
                                <div class="row">
                                    <div class="col-3 order-1 order-md-2 text-right">
                                        <button type="button" class="btn btn-primary edit_block" data-tippy="{{ __("global.edit_settings") }}" data-tippy-arrow="true" data-tippy-placement="left"><i class="fas fa-w fa-edit"></i></button>
                                        <button type="submit" class="btn btn-success save_block d-none" data-tippy="{{ __("global.save_settings") }}" data-tippy-arrow="true" data-tippy-placement="left"><i class="fas fa-w fa-save"></i></button>
                                    </div>
                                    <div class="col-9">
                                        <h4 class="c-grey-900"><i class="fas fa-w fa-balance-scale"></i> Probatium</h4>
                                        <p>Báscula y Tallimetro inteligente.</p>
                                    </div>
                                </div>
                        
                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="ip">IP</label>
                                            <input type="text" class="form-control-plaintext" id="ip" name="probatium[ip]" value="{{ old("probatium.ip", config("app.probatium.ip"))}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush