@php
    $notify = [];
    if(\Session::has("notify")) {
        $notify = \Session::get("notify");
    }
@endphp
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config("app.name", "SISGEC") }} | {{ __("global.desktop") }}</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset("css/sisgec.app.css") }}">
        <style>
            #loader {
                transition: all 0.3s ease-in-out;
                opacity: 1;
                visibility: visible;
                position: fixed;
                height: 100vh;
                width: 100%;
                background: #fff;
                z-index: 90000;
            }
            #loader.fadeOut {
                opacity: 0;
                visibility: hidden;
            }
            .spinner {
                width: 40px;
                height: 40px;
                position: absolute;
                top: calc(50% - 20px);
                left: calc(50% - 20px);
                background-color: #333;
                border-radius: 100%;
                -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
                animation: sk-scaleout 1.0s infinite ease-in-out;
            }
            @-webkit-keyframes sk-scaleout {
                0% { -webkit-transform: scale(0) }
                100% {
                -webkit-transform: scale(1.0);
                opacity: 0;
                }
            }
            @keyframes sk-scaleout {
                0% {
                -webkit-transform: scale(0);
                transform: scale(0);
                } 100% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
                opacity: 0;
                }
            }
        </style>
        <script>
            var HOME_URL = "{{ url("") }}";
            var I18N = {
                'lang': "{{ config('app.locale') }}",
                'years': "{{ __('person.years') }}",
                'are_your_sure': "{{ __('global.are_your_sure') }}",
                'sure_remove': "{{ __('global.sure_remove') }}",
                'close': "{{ __('global.close') }}",
                'description': "{{ __('global.description') }}",
                'title': "{{ __('global.title') }}",
                'date': "{{ __('global.date') }}",
                'cancel': "{{ __('global.cancel') }}",
                'ok': "{{ __('global.ok') }}",
                'processing': "{{ __('global.processing') }}",
                'sorry': "{{ __('error.sorry') }}",
                'an_error_has_occurred': "{{ __('error.an_error_has_occurred') }}",
                'edit_settings': "{{ __('global.edit_settings') }}",
                'cancel_edit': "{{ __('global.cancel_edit') }}",
                'saving_draft': "{{ __('global.saving_draft') }}",
                'saved_draft': "{{ __('global.saved_draft') }}",
                'cancel_alert_title': "{{__('global.cancel_alert_title')}}",
                'cancel_alert_text': "{{__('global.cancel_alert_text')}}"
            };
            var Notifications = '{!! json_encode($notify) !!}';
            var ProbatiumIP = "{{ config('app.probatium.ip') }}";
        </script>
    </head>
    <body class="app">
        <div id="loader">
            <div class="spinner"></div>
        </div>

        <script>
            window.addEventListener('load', () => {
                const loader = document.getElementById('loader');
                setTimeout(() => {
                loader.classList.add('fadeOut');
                }, 300);
            });
        </script>

        <div class="app-sisgec">
            @include('parts.sidebar')
        
            <div class="page-container">
                @include('parts.header')

                <main class='main-content bgc-grey-100'>
                    <div id='mainContent'>
                        @section('content')
                        @show
                    </div>
                </main>

                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                    <span>Copyright &copy; {{ date("Y") }} <i>UI</i> diseñada por <a href="https://colorlib.com" target='_blank' title="Colorlib">Colorlib</a> y programado por <a href="https://nidiasoft.com" title="Nidiasoft">Nidiasoft</a>.</span>
                </footer>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="{{ asset("js/sisgec.app.js") }}"></script>
        @stack('scripts')
    </body>
</html>