<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'SITI STORES')</title>

    <!-- Styles -->
    <style>
.breadcrumb-custom {
    font-size: 16px;
    color: #6c757d;
    margin: 20px 0;
    font-weight: 500;
}

.breadcrumb-custom a {
    color: #0d6efd;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-custom a:hover {
    text-decoration: underline;
    color: #0a58ca;
}

.breadcrumb-custom span + span::before {
    content: " > ";
    padding: 0 6px;
    color: #adb5bd;
}
</style>
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">

    @include('partial.header')

    <div id="layoutSidenav">
        @include('partial.sidebar')

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            @include('partial.footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    @stack('scripts')
</body>
</html>
