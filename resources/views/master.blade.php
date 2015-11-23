<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title> @yield('title') </title>
    <!--Twitter Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">

    <!--jquery js-->
    <script src="/js/jquery-1.11.3.min.js"></script>

    <!--Saját css-->
    <link rel="stylesheet" href="/css/styles.css">

    <!--DataTables css-->
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.min.css">

    <!--Select2 css-->
    <link rel="stylesheet" type="text/css" href="/css/select2-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/select2.css">

    <!--Select2 js-->
    <script src="/js/select2.min.js"></script>
    <script src="/js/select2_locale_hu.js"></script>

    <!--DataTables js-->
    <script src="/js/jquery.dataTables.min.js"></script>

    <!--Twitter Bootstrap js-->
    <script src="/js/bootstrap.min.js"></script>

    <!--Masked_input js-->
    <script src="/js/jquery.maskedinput.js"></script>



</head>
<body>

@include('shared.navbar')

@yield('content')

        <!--Saját js-->
<script src="/js/pentathlon.js"></script>

</body>

</html>