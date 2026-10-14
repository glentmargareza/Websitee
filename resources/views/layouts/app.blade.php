<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Jeep Wukirsari - Paket wisata jeep petualangan di Wukirsari. Nikmati sensasi off-road yang mendebarkan bersama kami.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Jeep Wukirsari') | Wisata Jeep Wukirsari</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS Utama --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Stack untuk CSS tambahan per halaman --}}
    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten Utama --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- JavaScript Utama --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Stack untuk JS tambahan per halaman --}}
    @stack('scripts')

</body>
</html>
