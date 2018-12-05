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
            </div>
        </div>
        <div class="col-12 col-sm-9">
            <div class="tab-content" id="user-options-tabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="bgc-white p-20 bd">    
                        <div class="block">
                            <form action="{{ route("assistants.update") }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="assistant_id" value="{{auth()->user()->assistant->id}}">
                                <div class="row">
                                    <div class="col-3 order-1 order-md-2 text-right">
                                        <button type="button" class="btn btn-primary edit_block"><i class="fas fa-w fa-edit"></i></button>
                                        <button type="submit" class="btn btn-success save_block d-none"><i class="fas fa-w fa-save"></i></button>
                                    </div>
                                    <div class="col-9">
                                        <h4 class="c-grey-900"><i class="fas fa-w fa-user"></i> {{ __("global.general_info") }}</h4>
                                    </div>
                                </div>
                        
                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_name">{{ __("person.name") }}</label>
                                            <input type="text" class="form-control-plaintext" id="user_name" name="user[name]" value="{{ old("user.name", auth()->user()->name) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_lastname">{{ __("person.lastname") }}</label>
                                            <input type="text" class="form-control-plaintext" id="user_lastname" name="user[lastname]" value="{{ old("user.lastname", auth()->user()->lastname) }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_email">{{ __("person.email") }}</label>
                                            <input type="email" class="form-control-plaintext" id="user_email" name="user[email]" value="{{ old("user.email", auth()->user()->email) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_title">{{ __("person.title") }}</label>
                                            <input type="text" class="form-control-plaintext" id="user_title" name="user[title]" value="{{ old("user.email", auth()->user()->title) }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_phone">{{ __("person.phone") }}</label>
                                            <input id="phone" type="text" class="form-control-plaintext" id="user_phone" name="user[phone]" value="{{ old("user.phone", auth()->user()->phone) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <div class="bgc-white p-20 bd">
                        <div class="block">
                            <form action="{{ route("assistants.update") }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="assistant_id" value="{{auth()->user()->assistant->id}}">
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
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush