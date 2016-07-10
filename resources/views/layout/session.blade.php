<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 20px;
      border-radius: 0;
    }

    a:hover, a:focus {
      text-decoration: none;
    }

    .navbar-brand{ padding: 2px; }

    .navbar-inverse .navbar-nav > li > a{color: #E0F7FA;}
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <img class="navbar-brand img-circle" src="{{ Session::get('avatar') }}">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a>Welcome, {{ Session::get('name') }}</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



<div class="container-fluid">  
  @yield('content')
</div><br><br>

<!-- <footer class="container-fluid text-center">
  <p>Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer> -->

</body>
</html>