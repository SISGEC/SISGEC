@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="c-grey-900 mT-10 mB-30"><a href="{{ route("assistants") }}">{{ __("global.assistants") }}</a> > {{ $assistant->full_name }}</h2>
            <div class="btn-group">
                <a class="btn btn-success" href="{{ route("assistants.edit", $assistant->id) }}">{{ __("global.edit_assistant") }}</a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">{{ __("global.open_options") }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-danger remove_this" href="{{ route("assistant.remove", $assistant->id) }}">{{ __("global.remove_assistant") }}</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <div class="profile-list-info two-columns">
                    <ul>
                        <li>
                            <strong>{{ __("person.name") }}:</strong> {{ $assistant->name }}
                        </li>
                        <li>
                            <strong>{{ __("person.lastname") }}:</strong> {{ $assistant->lastname }}
                        </li>
                        <li>
                            <strong>{{ __("person.email") }}:</strong> {{ $assistant->email }}
                        </li>
                        <li>
                            <strong>{{ __("person.phone") }}:</strong> {{ $assistant->phone }}
                        </li>
                        <li>
                            <strong>{{ __("person.title") }}:</strong> {{ $assistant->title }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection