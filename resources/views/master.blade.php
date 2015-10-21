<html>
<head>
    <title> @yield('title') </title>
    <!--Twitter Bootstrap-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">


</head>
<body>

@include('shared.navbar')

@yield('content')

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>

</html>