@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.prescriptions_new") }} </h2>        
        </div>
    </div>

    <div class="row gap-20 masonry pos-r">
    	<div class="masonry-sizer col-md-12"></div>
    	<div class="masonry-item col-md-12">
        	<div class="bgc-white p-20 bd">
            	<h4 class="c-grey-900">1. {{ __("global.prescription") }}</h4>
            	<div class="mT-30">
                	<div class="row">
                    	<div class="col-6">
                        	<div class="form-group">
                            	<label for="name">{{ __("person.full_name") }}</label>
                        		<div class="input-group">
                                	<input type="text" class="form-control" id="name" name="patient[name]" placeholder="{{ __("person.name") }}" />
                              	</div>
                          	</div>
 
                        	<div class="form-group">
                <div class="row">
                  <div class="col-2">
                    <label for="birthdate">{{ __("person.sex") }}</label>
									</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="patient[sex]" id="sexm" checked value="0">
                                        <label class="form-check-label" for="sexm">{{ __("global.man") }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="patient[sex]" id="sexw" value="1">
                                        <label class="form-check-label" for="sexw">{{ __("global.woman") }}</label>
									</div>
								</div>
								<label for="date">{{ __("Date") }}</label>
									<div class="input-group">
										<input type="text"  data-provide="datepicker" class="form-control" id="date" name="date" placeholder="{{ __("Date") }}" />
									</div>
							</div>
                    	</div>
					
						<div class="col-6">
							<div class="form-group">
								<div class="row">
									<div class="col-4">
										<label for="weight">{{ __("person.weight") }}</label>
										<input type="text" class="form-control" id="weight" name="measure[weight]" value="" />
									</div>
									<div class="col-4">
										<label for="height">{{ __("person.height") }}</label>
										<input type="text" class="form-control" id="height" name="measure[height]" value="" />
									</div>
									<div class="col-4">
										<label for="temperature">{{ __("person.temperature") }}</label>
										<input type="text" class="form-control" id="temperature" name="measure[temperature]" value="" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-4">
										<label for="heart_rate">{{ __("person.heart_rate") }}</label>
										<input type="text" class="form-control" id="heart_rate" name="measure[heart_rate]" value="" />
									</div>
									<div class="col-4">
										<label for="blood_pressure">{{ __("person.blood_pressure") }}</label>
										<input type="text" class="form-control" id="blood_pressure" name="measure[blood_pressure]" value="" />
									</div>
									<div class="col-4">
										<label or="breathing_frequency">{{ __("person.breathing_frequency") }}</label>
										<input type="text" class="form-control" id="breathing_frequency" name="measure[breathing_frequency]" value="" />
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
                            <div class="col-2 text-right">
                                <label class="c-grey-900 pT-20" for="inherit_family">{{ __("global.prescription") }}</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="prescription" id="prescription" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
	
	<div class="modal fade" id="calendar-edit">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="bd p-15">
				  <h5 class="m-0">Date</h5>
				</div>
				<div class="modal-body">
				  <form>
					<div class="row">
					  <div class="col-md-6">
						<label class="fw-500">Day</label>
						<div class="timepicker-input input-icon form-group">
						  <div class="input-group">
							<div class="input-group-addon bgc-white bd bdwR-0">
							  <i class="ti-calendar"></i>
							</div>
							<input type="text" class="form-control bdc-grey-200 start-date" placeholder="Datepicker" data-provide="datepicker">
						  </div>
						</div>
					  </div>
					</div>
					<div class="text-right">
					  <button class="btn btn-primary cur-p" data-dismiss="modal">Done</button>
					</div>
				  </form>
				</div>
			  </div>
			</div>
		  </div>
@endsection