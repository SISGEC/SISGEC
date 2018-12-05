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
        $patients = isset($patients) ?  $patients : collect([]);
    @endphp

    @if(Session::has('success'))
        {{Session::get('success')}}
    @endif

    @if($errors->has("error"))
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif

    @if ($patients->isNotEmpty())
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __("person.name") }}</th>
                    <th>{{ __("person.sex") }}</th>
                    <th>{{ __("person.age") }}</th>
                    <th>{{ __("person.phone") }}</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ __("person.name") }}</th>
                    <th>{{ __("person.sex") }}</th>
                    <th>{{ __("person.age") }}</th>
                    <th>{{ __("person.phone") }}</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $patient->full_name }}</td>
                        <td>{{ $patient->sex == 1 ? __("global.woman") : __("global.man") }}</td>
                        <td>{{ $patient->age }} {{ __("person.years") }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td><a class="btn btn-primary" href="{{ route('patient', $patient->id) }}">{{ __("global.see_patient") }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
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
    @endif
@endsection