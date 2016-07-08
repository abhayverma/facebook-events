<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/app.css">
        
        <script src="/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
