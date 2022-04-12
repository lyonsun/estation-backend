<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estation Network</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="header bg-zinc-700 text-white px-4 py-10 uppercase font-bold flex justify-center items-center">
            <div class="text-3xl md:text-6xl underline">
                <a href="/">Estation Network</a>
            </div>
        </div>

        <div class="bg-zinc-700 text-white p-4 flex justify-center items-center gap-8 text-lg uppercase">
            <a href="/">Home</a>
            <a href="{{ route('companies.index') }}">Companies</a>
            <a href="{{ route('stations.index') }}">Stations</a>
        </div>

        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </div>

    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>

</html>