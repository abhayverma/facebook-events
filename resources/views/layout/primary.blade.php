<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/app.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <style type="text/css"> .alert{margin-top: 3%; margin-bottom: 0;}</style>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
