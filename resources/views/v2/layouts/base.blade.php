<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config("app.name", "SISGEC") }} | {{ __("Clinical record manager") }}</title>

    <link rel="stylesheet" href="{{ asset("css/sisgec-v2.0.css") }}">
    <script async src="{{asset("js/sisgec-v2.0.js")}}"></script>
</head>
<body>
    <div class="container-fluid container-no-padding">
        <div class="row no-gutters">
            <div class="col-12">
                <main class="wrapper">
                    @includeIf('v2.parts.sidebar')
                    <div class="content">
                        @includeIf('v2.parts.header')
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
</html>