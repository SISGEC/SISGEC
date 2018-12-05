<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li>
                <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                <i class="ti-menu"></i>
                </a>
            </li>
            <li class="search-input active">
                <input id="searched" class="form-control" type="text" placeholder="{{ __("global.search") }}">
            </li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown new-button">
                <a class="btn btn-primary dropdown-toggle no-after" id="newButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-plus"></i> {{ __("global.new") }}
                </a>
                <div class="dropdown-menu" aria-labelledby="newButton">
                    <a class="dropdown-item" href="{{ route("patients.new") }}">{{ __("global.patient") }}</a>
                    @if (auth()->user()->is_doctor())
                        <a class="dropdown-item" href="{{ route("evolution_note.new") }}">{{ __("global.tracing") }}</a>
                        <a class="dropdown-item" href="{{ route("prescription.new") }}">{{ __("global.prescription") }}</a>
                    @endif                   
                    <a class="dropdown-item" href="{{ route("medical_appointments") }}">{{ __("global.medical_appointment") }}</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                    <div class="peer mR-10">
                        {{--<img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt="">--}}
                    </div>
                    <div class="peer">
                        <span class="fsz-sm c-grey-900">{{ auth()->user()->title }} {{ auth()->user()->full_name }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    <li>
                        <a href="{{ route("doctor.settings") }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-settings mR-10"></i>
                            <span>{{ __("global.settings") }}</span>
                        </a>
                    </li>
                    {{--<li>
                        <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-user mR-10"></i>
                        <span>Profile</span>
                        </a>
                    </li>--}}
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-power-off mR-10"></i>
                            <span>{{ __("global.logout") }}</span>
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>