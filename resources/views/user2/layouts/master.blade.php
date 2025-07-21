<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>{{ __('messages.dashboard') }}</title>
  <link rel="shortcut icon" href="{{ asset('user2/images/favicon.png') }}" type="">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('user2/css/bootstrap.css') }}" />
  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
  <!-- font awesome style -->
  <link href="{{ asset('user2/css/font-awesome.min.css') }}" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('user2/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('user2/css/responsive.css') }}" rel="stylesheet" />
  @yield('css-section')
</head>
<body>
  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('user2/images/hero-bg.jpg') }}" alt="">
    </div>
    @include('user2.layouts.navbar')
    @yield('content')
  </div>
  @include('user2.layouts.footer')
  <!-- JS Files -->
  <script src="{{ asset('user2/js/jquery-3.4.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('user2/js/custom.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  @yield('js-section')
</body>
</html>
