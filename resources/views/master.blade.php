<html>
    <head>
        <title>Kozmetika:D</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://js.stripe.com/v3/"></script>
    </head>
    <body id="main-body">
            <div class="container" id="navigation-bar">
                @include('shop.navigation')
            </div>
            @if(session()->has('success_verify'))
                <div class="alert alert-success">
                    {{session()->get('success_verify')}}
                </div>
            @endif
            <div class="container" id="body">
                @yield('body')
            </div>
            @include('shop.footer')
    </body>
</html>



