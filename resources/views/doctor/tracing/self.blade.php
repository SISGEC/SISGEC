@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.evolution_note") }} > {{ $tracing->name }}</h2>
            <a href="{{ route("evolution_note.edit", $tracing->id) }}" class="btn btn-secondary">
                {{ __("global.edit_tracing") }}
            </a>
        </div>
    </div>
@endsection