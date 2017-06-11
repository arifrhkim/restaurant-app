<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

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

              <div class="col-md-2">
                @include('includes.sidebar')
              </div>

              <div class="col-md-8 col-md-offset-1">
                @yield('content')
              </div>

            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
