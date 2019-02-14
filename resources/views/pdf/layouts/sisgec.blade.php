<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config("site.name", "SISGEC") }} | {{ __("global.desktop") }}</title>
        <link rel="stylesheet" href="{{ asset("css/pdf.css") }}">
        @stack('header_scripts')
    </head>
    <body class="app">
        @php
            $doctor = auth()->user();
        @endphp
        <header class="header">
            <div class="container-full">
                <div class="logo">
                    {!! get_doctor_logo($doctor) !!}
                </div>
                @php
                    $contact_data = [
                        $doctor->phone,
                        config("app.office_phone"),
                        $doctor->email,
                    ];
                @endphp
                <div class="info">
                    <h4>{{ $doctor->title }} {{ $doctor->formal_name}}</h4>
                    <p>{{ $doctor->specialty }}, {{ __("global.professional_license") }}: {{ $doctor->professional_license }}, {{ $doctor->university }}</p>
                    <p>{{ config("app.office_address") }}</p>
                    <p>{{ implode(" - ", $contact_data) }}</p>
                </div>
            </div>
        </header>
        <div class="page-container">
            <main class='main-content'>
                <div id='mainContent'>
                    @section('content')
                        
                    @show
                </div>
            </main>
        </div>
        <footer>
            <div class="pagenum-container">{{ __("global.page") }} <span class="pagenum"></span></div>
        </footer>
    </body>
</html>