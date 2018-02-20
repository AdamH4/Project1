<html>
    <head>
        <title>Kozmetika:D</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ URL::to('public/js/checkout.js') }}"></script>
    </head>
    <body>


            @include('shop.navigation')

            @yield('body')

            @include('shop.footer')



    </body>
</html>



