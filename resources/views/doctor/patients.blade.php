@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col-6 text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.patients") }} </h2>
        </div>
        <div class="col-6 text-right">
            <a class="btn cur-p btn-success" href="{{ route("patients.new") }}"><i class="fa fa-address-card"></i> {{ __("global.new_patient") }}</a>
        </div>
    </div>
    @php
        $patients = isset($patients) ?  $patients : [];
    @endphp
    @forelse ($patients as $patient)
        
    @empty
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item  w-100">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100 banner-message banner-message--error">
                    <h4 class="mT-10 mB-30">{{ __("error.no_patients") }}</h4>
                    <i class="ti-face-sad"></i>
                </div>
            </div>
        </div>
    </div>
    @endforelse
@endsection