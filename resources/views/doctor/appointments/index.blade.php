@extends('layouts.sisgec')

@section('content')
    <div class="row align-items-center">
        <div class="col text-left">
            <h2 class="c-grey-900 mT-10 mB-30">{{ __("global.medical_appointments_new") }} </h2>
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-4">
                    <div class="bdrs-3 ov-h bgc-white bd">
                      <div class="bgc-deep-purple-500 ta-c p-30">
                        <h1 class="fw-300 mB-5 lh-1 c-white">{{ $now->format('d') }}{{--<span class="fsz-def">{{ $now->format('S') }}</span>--}}</h1>
                        <h3 class="c-white">{{ __($now->format('l')) }}</h3>
                      </div>
                      <div class="pos-r">
                        <button type="button" data-tippy="{{ __("global.click_to_add_a_new_medical_appointment") }}" data-tippy-arrow="true" data-toggle="modal" data-target="#calendar-edit" class="mT-nv-50 pos-a r-10 t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-warning">
                          <i class="ti-plus"></i>
                        </button>
                        <ul class="m-0 p-0 mT-20 appointments-list">
                          @forelse ($appointments as $appointment)
                            @include('block.appointments-list-item', $appointment)
                          @empty
                            <li class="bdB peers ai-c jc-sb fxw-nw">
                              <div class="not-appointments">
                                {{ __("global.not_appointments_today") }}
                                <button type="button" data-toggle="modal" data-target="#calendar-edit"  class="btn btn-success">{{ __("global.add_one") }}</button>
                              </div>
                            </li>
                          @endforelse
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div id='full-calendar'></div>
                  </div>
                </div>
                <div class="modal new-appointment fade" id="calendar-edit">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5>{{ __("global.add_event") }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("global.close") }}">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route("medical_appointments.save") }}" method="POST">
                            @csrf
                          <div class="form-group">
                            <label class="fw-500">{{ __("global.event_title") }}</label>
                            <input class="form-control bdc-grey-200" name="title" placeholder="{{ __("global.example_event_title") }}" required>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="timepicker-input input-icon form-group">
                                <div class="row">
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="ncdate" class="fw-500">{{ __("global.date") }}</label>
                                      <input type="text" id="ncdate" name="date" class="form-control bdc-grey-200 start-date" placeholder="mm/dd/yyyy" data-provide="datepicker" required>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="nchour" class="fw-500">{{ __("global.scheduler") }}</label>
                                      <div class="input-group">
                                        <select class="form-control custom-select nchour" id="nchour" name="hour">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                            @endfor
                                          </select>
                                          <select class="form-control custom-select ncminutes" id="ncminutes" name="minutes">
                                            @for ($i = 0; $i < 60; $i+=30)
                                                <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                            @endfor
                                          </select>
                                          <select class="form-control custom-select nca" id="nca" name="a">
                                              <option value="am">A.M</option>
                                              <option value="pm">P.M</option>
                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="fw-500">{{ __("global.description") }}</label>
                            <textarea name="description" class="form-control bdc-grey-200" rows='5' placeholder="{{ __("global.example_event_description") }}" required></textarea>
                          </div>
                          <div class="text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __("global.cancel") }}</button>
                            <button type="submit" class="btn btn-success cur-p">{{ __("global.save") }}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>

  <div class="modal fade view-appointment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("global.close") }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>{{ __("global.date") }}:</strong> <span class="date"></span></p>
                <p><strong>{{ __("global.description") }}:</strong></p>
                <p class="desc"></p>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-danger remove_this">{{ __("global.remove") }}</a>
              <a href="javascript:" class="btn btn-primary appointment_edit_button" data-dismiss="modal" data-appointment_id="">{{ __("global.edit") }}</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("global.close") }}</button>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade edit-appointment" tabindex="-1" role="dialog">
    <form action="" method="POST">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __("global.edit_appointment") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("global.close") }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <input type="hidden" name="appointment_id" value="">
                <div class="form-group">
                  <label class="fw-500">{{ __("global.event_title") }}</label>
                  <input class="form-control bdc-grey-200" name="title" placeholder="{{ __("global.example_event_title") }}" required>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="timepicker-input input-icon form-group">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="ncdate" class="fw-500">{{ __("global.date") }}</label>
                            <input type="text" id="ncdate" name="date" class="form-control bdc-grey-200 start-date" placeholder="mm/dd/yyyy" data-provide="datepicker" required>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="nchour" class="fw-500">{{ __("global.scheduler") }}</label>
                            <div class="input-group">
                              <select class="form-control custom-select" name="hour">
                                  @for ($i = 1; $i <= 12; $i++)
                                      <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                  @endfor
                                </select>
                                <select class="form-control custom-select" name="minutes">
                                  @for ($i = 0; $i < 60; $i+=30)
                                      <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                  @endfor
                                </select>
                                <select class="form-control custom-select" name="a">
                                    <option value="am">A.M</option>
                                    <option value="pm">P.M</option>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="fw-500">{{ __("global.description") }}</label>
                  <textarea name="description" class="form-control bdc-grey-200" rows='5' required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __("global.cancel") }}</button>
                <button type="submit" class="btn btn-success">{{ __("global.save") }}</button>
            </div>
        </div>
      </div>
    </form>
  </div>
@endsection
