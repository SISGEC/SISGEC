@extends('layouts.sisgec')

@section('content')
    <form action="{{ route("prescription.save") }}" method="POST" class="inputs-auto-scroll">
        @csrf
        <input type="hidden" name="id" value="{{ $patient->id }}">
        <div class="row align-items-center">
            <div class="col text-left">
                <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.prescriptions_new") }} </h2>
            </div>
        </div>
        
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <h4 class="c-grey-900">1. {{ __("global.general_info") }}</h4>
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">{{ __("person.full_name") }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="patient[name]" placeholder="{{ __("person.name") }}" value="{{ old("patient.name", $patient->full_name) }}" />
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="date">{{ __("Date") }}</label>
                                    <div class="input-group">
                                        <input type="text" data-provide="datepicker" class="form-control" id="date" name="date" placeholder="dd/mm/yyyy" value="{{ old("date", date("d/m/Y")) }}" />
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
                    <h4 class="c-grey-900">2. {{ __("global.prescription") }}</h4>
                    <div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="prescription" id="prescription" cols="30" rows="10">{{ old("prescription", "") }}</textarea>
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
                            <button class="btn btn-danger">{{ __("global.exit") }}</button>
                            <button class="btn btn-success ml-2">{{ __("global.save_patient") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection