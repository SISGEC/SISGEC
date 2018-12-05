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
    <title>{{ config("app.name", "SISGEC") }} | Login</title>
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
        var Notifications = '{!! json_encode($notify) !!}';
    </script>
  </head>
  <body class="app">
    <div id='loader'>
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
    <div class="peers ai-s fxw-nw h-100vh">
      <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("{{ asset("images/medical-background.jpg") }}")'>
        <div class="pos-a centerXY">
          <div class="bdrs-50p pos-r" style='width: 120px; height: 120px;'>
            <img class="pos-a centerXY" src="{{ config("app.office_logo") }}" width="350" height="auto" alt="">
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        <h4 class="fw-300 c-grey-900 mB-40">{{ __("auth.login") }}</h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="form-group">
            <label class="text-normal text-dark">{{ __("auth.email") }}</label>
            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="example@example.com" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label class="text-normal text-dark">{{ __("auth.password") }}</label>
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __("auth.password") }}" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">
              <div class="peer">
                <div class="checkbox checkbox-info peers ai-c">
                  <input type="checkbox" id="inputCall1" name="remember" {{ old('remember') ? 'checked' : '' }} class="peer">
                  <label for="inputCall1" class=" peers peer-greed js-sb ai-c">
                    <span class="peer peer-greed">{{ __("auth.remember_me") }}</span>
                  </label>
                </div>
              </div>
              <div class="peer">
                <button class="btn btn-primary">{{ __("auth.login") }}</button>
              </div>
            </div>
            <div class="peers ai-c jc-sb fxw-nw mt-5">
              <div class="peer text-center w-100">
                <a class="btn btn-link" href="{{ url("/password/reset") }}">{{ __("auth.forgot_your_password") }}</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>