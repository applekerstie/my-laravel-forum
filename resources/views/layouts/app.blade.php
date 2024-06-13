<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('style')

    <!-- Scripts -->
  <script>
    window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
      'currentUser' => $currentUser,
      //'currentRouteName' => $currentRouteName,
      //'currentLocale' => $currentLocale,
      //'currentUrl' => $currentUrl,
    ]); ?>
  </script>
</head>
<body id="app-layout">
    @include('layouts.partial.navigation')

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    @include('layouts.partial.footer')

    <script src="{{ mix('js/app.js') }}"></script>

    @yield('script')
</body>
</html>