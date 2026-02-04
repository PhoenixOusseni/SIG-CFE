<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    @yield('title')
    <title>SIG-FORVISMAZARS</title>
    @yield('style')
    @include('partials.style')
    @notifyCss
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }

        .btn-1 {
            background-color: #2f663f;
            color: white;
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
