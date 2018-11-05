@extends('layouts.sisgec')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item  w-100">
            <div class="row gap-20">
                <div class='col-md-4'>
                    @component('block.simple-statistics', [
                        'sparklinedash' => 'sparklinedash',
                        'color' => 'green'
                    ])
                        @slot("title")
                            Pacientes atendidos esta semana
                        @endslot
                    @endcomponent    
                </div>

                <div class='col-md-4'>
                    @component('block.simple-statistics', [
                        'sparklinedash' => 'sparklinedash',
                        'color' => 'red'
                    ])
                        @slot("title")
                            Citas agendadas esta semana
                        @endslot
                    @endcomponent
                </div>

                <div class='col-md-4'>
                    @component('block.simple-statistics', [
                        'sparklinedash' => 'sparklinedash',
                        'color' => 'purple'
                    ])
                        @slot("title")
                            Paciente únicos esta semana
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