@extends('layouts.sisgec')

@section('content')
    <form action="{{ route("prescription.update") }}" method="POST" class="inputs-auto-scroll">
        @csrf
        <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
        <div class="row align-items-center">
            <div class="col text-left">
                <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.prescriptions_edit") }} > {{ $prescription->initial_clinical_history->patient->full_name }}</h2>
            </div>
        </div>
        
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-12"></div>
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <h4 class="c-grey-900">{{ __("global.general_info") }}</h4>
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">{{ __("person.full_name") }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" placeholder="{{ __("person.name") }}" value="{{ $prescription->initial_clinical_history->patient->full_name }}" readonly />
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="date">{{ __("global.folio") }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="folio" name="folio" placeholder="#00000" value="{{ old("folio", $prescription->folio) }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="date">{{ __("global.date") }} <span>*</span></label>
                                            <div class="input-group">
                                                <input type="text" data-provide="datepicker" class="form-control" id="date" name="date" placeholder="dd/mm/yyyy" value="{{ old("date", $prescription->date) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="weight">{{ __("person.weight") }}</label>
                                            <input type="text" class="form-control" id="weight" name="measure[weight]" value="{{ old("measure.weight", $prescription->initial_clinical_history->patient->measures->weight) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label for="height">{{ __("person.height") }}</label>
                                            <input type="text" class="form-control" id="height" name="measure[height]" value="{{ old("measure.height", $prescription->initial_clinical_history->patient->measures->height) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label for="temperature">{{ __("person.temperature") }}</label>
                                            <input type="text" class="form-control" id="temperature" name="measure[temperature]" value="{{ old("measure.temperature", $prescription->initial_clinical_history->patient->measures->temperature) }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="heart_rate">{{ __("person.heart_rate") }}</label>
                                            <input type="text" class="form-control" id="heart_rate" name="measure[heart_rate]" value="{{ old("measure.heart_rate", $prescription->initial_clinical_history->patient->measures->heart_rate) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label for="blood_pressure">{{ __("person.blood_pressure") }}</label>
                                            <input type="text" class="form-control" id="blood_pressure" name="measure[blood_pressure]" value="{{ old("measure.blood_pressure", $prescription->initial_clinical_history->patient->measures->blood_pressure) }}" />
                                        </div>
                                        <div class="col-4">
                                            <label or="breathing_frequency">{{ __("person.breathing_frequency") }}</label>
                                            <input type="text" class="form-control" id="breathing_frequency" name="measure[breathing_frequency]" value="{{ old("measure.breathing_frequency", $prescription->initial_clinical_history->patient->measures->breathing_frequency) }}" />
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
                    <h4 class="c-grey-900">2. {{ __("global.content") }} <span class="cred">*</span></h4>
                    <div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="prescription" id="prescription" cols="30" rows="10" required>{{ old("prescription", $prescription->prescription) }}</textarea>
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
                            <a class="btn btn-danger" href="{{ route("prescription", ["id" => $prescription->id]) }}">{{ __("global.exit") }}</a>
                            <button class="btn btn-success ml-2">{{ __("global.save_prescription") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection