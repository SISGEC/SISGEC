@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.new_assistant") }} </h2>
        </div>
    </div>

    <form action="{{ route("assistants.save") }}" method="POST" class="inputs-auto-scroll">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ doctor()->doctor_id == 1 ? "1" : doctor()->doctor_id }}">
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd input-block">
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">{{ __("person.full_name") }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="user[name]" placeholder="{{ __("person.name") }}" value="{{ old("user.name", "") }}" required />
                                        <input type="text" class="form-control" id="lastname" name="user[lastname]" placeholder="{{ __("person.lastname") }}" value="{{ old("user.lastname", "") }}" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="phone">{{ __("person.phone") }}</label>
                                            <input type="text" class="form-control" id="phone" name="user[phone]" value="{{ old("user.phone", "") }}" />
                                        </div>
                                        <div class="col-6">
                                            <label for="title">{{ __("person.title") }}</label>
                                            <input type="text" class="form-control" id="title" name="user[title]" value="{{ old("user.title", "") }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email">{{ __("person.email") }}</label>
                                            <input type="email" class="form-control" id="email" name="user[email]" value="{{ old("user.email", "") }}" required />
                                        </div>
                                        <div class="col-6">
                                            <label for="password">{{ __("person.password") }}</label>
                                            <input type="password" class="form-control" id="password" name="user[password]" value="{{ old("user.password", "") }}" required />
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
                            <a href="{{ route("assistants") }}" class="btn btn-danger">{{ __("global.exit") }}</a>
                            <button class="btn btn-success ml-2">{{ __("global.save_assistant") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection