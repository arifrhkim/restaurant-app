<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rest-app') }}</title>

    <link rel="icon" type="image/png" href="https://ta.artomodular.com/icon.png">

    <link rel="manifest" href="/manifest.json">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- ETC -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        @include('includes.navbar')

        <div class="container">
            <div class="row">

              <div class="col-md-2  col-md-offset-1">
                @include('includes.sidebar')
              </div>

              <div class="col-md-8">
                @yield('content')
              </div>

            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script>
    var refreshId = setInterval(function()
    {
    $('.notif').load('{{ url('/test') }}');
    }, 1000);
    </script>

    <script>
    var refreshId2 = setInterval(function()
    {
    $('.notif-cooked').load('{{ url('/testcooked') }}');
    }, 1000);
    </script>

</body>
</html>
