<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
    <title>What should i wear</title>
</head>
<body>

    @include('layouts/header')

    <div class="app">
        @yield('content')
    </div>

    @include('layouts/footer')



</body>
</html>
