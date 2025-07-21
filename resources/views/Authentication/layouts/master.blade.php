<!DOCTYPE html>
<html lang="en">
    <style>
        .btn-eye {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            padding: 0;
            z-index: 10;
        }
    </style>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset ('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
        <link href="{{asset ('admin/css/sb-admin-2.css')}}" rel="stylesheet">
        <link href="{{asset ('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="" style="background: linear-gradient(135deg, darkslategray, #2a9877);">

    <!-- Language Selector -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(app()->getLocale() == 'ar')
                    العربية
                @else
                    English
                @endif
            </button>
            <div class="dropdown-menu" aria-labelledby="languageDropdown">
                <a class="dropdown-item" href="{{ route('language.switch', 'en') }}">English</a>
                <a class="dropdown-item" href="{{ route('language.switch', 'ar') }}">العربية</a>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset ('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset ('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset ('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset ('admin/js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Language Dropdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('languageDropdown');
            const dropdownMenu = dropdownButton.nextElementSibling;

            dropdownButton.addEventListener('click', function(e) {
                e.preventDefault();
                dropdownMenu.classList.toggle('show');
            });

            // إغلاق الـ dropdown عند النقر خارجه
            document.addEventListener('click', function(e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>

    <style>
        .dropdown-menu {
            display: none;
        }
        .dropdown-menu.show {
            display: block;
        }
    </style>

</body>

</html>
