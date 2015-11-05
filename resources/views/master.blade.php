<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title> @yield('title') </title>
    <!--Twitter Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">

    <!--jquery js-->
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

    <!--Saját css-->
    <link rel="stylesheet" href="/css/styles.css">

    <!--DataTables css-->
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.min.css">


    <!--DataTables js-->
    <script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>

    <!--Twitter Bootstrap js-->
    <script src="/js/bootstrap.min.js"></script>



</head>
<body>

@include('shared.navbar')

@yield('content')

        <!--Saját js-->
<script src="/js/pentathlon.js"></script>

</body>

</html>