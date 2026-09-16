<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Midwife CSS -->
    <link rel="stylesheet" href="{{ asset('css/midwife.css') }}">

      <!-- add-mother CSS -->
    <link rel="stylesheet" href="{{ asset('css/add-mother.css') }}">

    <link rel="stylesheet" href="{{ asset('css/mother.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visits.css') }}">
    <link rel="stylesheet" href="{{ asset('css/medicines.css') }}">
    <link rel="stylesheet" href="{{ asset('css/health-record.css') }}">
    <link rel="stylesheet" href="{{ asset('css/health-report.css') }}">
</head>

<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/midwife.js') }}"></script>
    <script src="{{ asset('js/add-mother.js') }}"></script>
    <script src="{{ asset('js/mother.js') }}"></script>
    <script src="{{ asset('js/visits.js') }}"></script>
    <script src="{{ asset('js/medicines.js') }}"></script>
    <script src="{{ asset('js/health-record.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script src="{{ asset('js/health-report.js') }}"></script>

</body>
</html>