<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_templet.header')
    <title>{{ isset($page_title) && $page_title ? $page_title : 'iarifbd' }} - UCMAS360°</title>
    @include('dashboard_templet.custom_css_dashboard')
    {{-- set option for add css in future --}}
    @yield("custom_css_section")
</head>

<body>
    <div class="wrapper">
        @include('dashboard_templet.sidebar')
        {{-- set option for update sidebar in future --}}
        @yield('sidebar_section')

        <div class="main">
            @include('dashboard_templet.navbar')
            {{-- set option for update navbar in future --}}
            @yield('navbar_section')

            <main class="content">
                @include('dashboard_templet.main')
                {{-- set option for update main in future --}}
                @yield('main_section')
            </main>

            <footer class="footer">
                @include('dashboard_templet.footer')
                {{-- set option for update footer in future --}}
                @yield("footer_section")
            </footer>
        </div>
    </div>
    @include('dashboard_templet.custom_script')
    {{-- set option for add js in future --}}
    @yield("custom_js_section")

</body>

</html>
