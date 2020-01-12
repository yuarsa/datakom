<!DOCTYPE html>
<html>
<head>
    <title>DATAKOM - DELIVER INFORMATION SYSTEM</title>
    <link rel="stylesheet" href="{{ asset('css/login/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/app.min.css') }}">
</head>
<body class="authentication-bg authentication-bg-pattern">
    <div class="stripes-wraper">
        <div class="stripes">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="account-pages mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-4 col-xs-4">
                    <div class="logo mt-4">
                        <a href="{{ url('/') }}"><img src="{{ asset('img/logo-small.png') }}" class="img-responsive center-block" alt="logo"></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app/bootstrap.min.js') }}"></script>
</body>
</html>
