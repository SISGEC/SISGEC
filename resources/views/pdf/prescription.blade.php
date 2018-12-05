@extends('pdf.layouts.sisgec')

@section('content')
    @for ($i = 0; $i < 3; $i++)
        <div class="columns mt-h">
            <div class="column1 mw-100">
                <h1>{{ __("global.prescription") }} <small>({{ __("global.prescription_copy_$i") }})</small></h1>
            </div>
        </div>
    
        <div class="block">
            <div class="columns">
                <div class="column1">
                    <div class="profile-list-info">
                        <ul>
                            <li>
                                <strong>{{ __("global.creation_date") }}</strong> {{ $prescription->created_at->format("d/m/Y h:i a") }}
                            </li>
                            <li>
                                <strong>{{ __("global.printing_date") }}</strong> {{ date('d/m/Y h:i a') }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="column2">
                    <div class="profile-list-info">
                        <ul>
                            <li>
                                <strong>{{ __("global.folio") }}</strong> <span class="bold red mt-1">#{{ $prescription->folio }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="block">
            <h3>{{ __("global.identification_card") }}</h3>
            <div class="columns">
                <div class="column1 mw-100">
                    <div class="profile-list-info">
                        <ul>
                            <li>
                                <strong>{{ __("person.full_name") }}:</strong> {{ $patient->full_name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column1">
                    <div class="profile-list-info">
                        <ul>
                            <li>
                                <strong>{{ __("person.sex") }}:</strong> {{ $patient->sex == 1 ? __("global.woman") : __("global.man") }}
                            </li>
                            <li>
                                <strong>{{ __("person.age") }}:</strong> {{ $patient->age . " " . __("person.years") }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="column2">
                    <div class="profile-list-info">
                    <ul>
                        <li>
                            <strong>{{ __("person.weight") }}:</strong> {{ $patient->measures->weight }}
                        </li>
                        <li>
                            <strong>{{ __("person.height") }}:</strong> {{ $patient->measures->height }}
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    
        <div class="block">
            <div class="profile-list-description">
                <ul>
                    <li>
                        <h3>{{ __("global.rx") }}:</h3> {{ $prescription->prescription }}
                    </li>
                </ul>
            </div>
        </div>

        @php
            $doctor = auth()->user();
        @endphp
        
        <div class="signature v2">
            <div class="line">
                {{ $doctor->formal_name }}
            </div>
        </div>

        <div class="text-center mt-2 prescription-footer-note">
            <p>{{ __("global.prescription-footer-note") }}</p>
        </div>

        @if ($i < 2)
            <div class="page-break"></div>
        @endif
    @endfor
@endsection