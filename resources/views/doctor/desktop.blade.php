@extends('layouts.sisgec')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item  w-100">
            <div class="row gap-20">
                <div class='col-md-4'>
                    @component('block.simple-statistics', [
                        'sparklinedash' => 'patients_treated_last_week',
                        'color' => 'green'
                    ])
                        @slot("title")
                            {{ __("global.patients_treated_this_week") }}
                        @endslot
                    @endcomponent    
                </div>

                <div class='col-md-4'>
                    @component('block.simple-statistics', [
                        'sparklinedash' => 'scheduled_appointments_last_week',
                        'color' => 'red'
                    ])
                        @slot("title")
                            {{ __("global.appointments_scheduled_this_week") }}
                        @endslot
                    @endcomponent
                </div>

                <div class='col-md-4'>
                    @component('block.simple-statistics', [
                        'sparklinedash' => 'unique_patients_last_week',
                        'color' => 'purple'
                    ])
                        @slot("title")
                            {{ __("global.unique_patients_this_week") }}
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>

        <div class="masonry-item col-md-6">
            @component('block.line-chart', [
                'title' => 'Estadísticas Mensuales',
                'chart_id' => 'line-chart',
                'peers' => [
                    [
                        'title' => 'Pacientes únicos',
                        'color' => 'green',
                        'icon' => 'fa-level-up',
                        'percent' => '10%'
                    ],
                    [
                        'title' => 'Citas',
                        'color' => 'red',
                        'icon' => 'fa-level-down',
                        'percent' => '2%'
                    ]
                ]
            ])
            @endcomponent
        </div>
    </div>
@endsection