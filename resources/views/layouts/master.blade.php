<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')

    @yield('title')

    <title>SIG-CFE</title>

    @yield('style')

    @include('partials.style')

    @notifyCss
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }

        .btn-1 {
            background-color: #133e9a;
            color: white;
        }

        .form-control {
            padding: 9px 12px;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2f663f;
            box-shadow: 0 0 0 0.2rem rgba(47, 102, 63, 0.1);
        }

        .form-select {
            padding: 9px 12px;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            border-color: #2f663f;
            box-shadow: 0 0 0 0.2rem rgba(47, 102, 63, 0.1);
        }

        .page-header{
            background: #133e9a
        }
    </style>

<body class="nav-fixed">
    @include('notify::components.notify')
    @include('partials.header')
    <div id="layoutSidenav_content">

        @yield('content')

        @include('partials.footer')
    </div>
    </div>
    @include('partials.script')
    @notifyJs
    @yield('script')
</body>

</html>
