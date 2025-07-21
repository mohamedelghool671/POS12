<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ __('messages.dashboard') }}</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #content-wrapper {
            flex: 1;
        }
        .copyright {
            margin-top: auto;
        }

                        /* تحسين مظهر أزرار السايد بار */
        .sidebar-btn {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 8px;
            padding: 10px 15px;
            text-align: left;
            width: calc(100% - 16px);
            display: block;
            background-color: transparent;
            color: white;
            border: none;
            text-decoration: none;
        }

        .sidebar-btn:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            transform: translateX(5px);
            text-decoration: none;
            color: white;
        }

        .submenu-btn {
            transition: all 0.3s ease;
            border-radius: 6px;
            margin: 1px 4px;
            padding: 8px 12px;
            text-align: left;
            width: calc(100% - 8px);
            display: block;
            background-color: transparent;
            color: white;
            border: none;
            text-decoration: none;
        }

        .submenu-btn:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            transform: translateX(3px);
            text-decoration: none;
            color: white;
        }

        /* إصلاح مظهر الأيقونات */
        .sidebar-btn i, .submenu-btn i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
        }

                /* إصلاح مظهر الأزرار في السايد بار */
        .sidebar .nav-item {
            margin-bottom: 5px;
            list-style: none;
        }

        .sidebar .nav-item:last-child {
            margin-bottom: 0;
        }

        /* إصلاح مظهر زر تسجيل الخروج */
        .sidebar form {
            margin: 0;
            padding: 0;
        }

        .sidebar form button {
            cursor: pointer;
        }

        /* إصلاح مظهر الأزرار الثلاثة الأخيرة */
        .sidebar .nav-item:last-child,
        .sidebar .nav-item:nth-last-child(2),
        .sidebar .nav-item:nth-last-child(3) {
            margin-bottom: 8px;
        }

        /* إصلاح مظهر الـ submenu */
        .submenu {
            margin-top: 5px;
            padding-left: 15px;
        }

        .submenu .nav-item {
            margin-bottom: 3px;
        }

        /* تحسين مظهر الكروت في المحتوى */
        .card {
            background-color: #16213e !important;
            border: 1px solid #0f3460 !important;
            color: white !important;
        }

        .card-header {
            background-color: #0f3460 !important;
            border-bottom: 1px solid #0f3460 !important;
            color: white !important;
        }

        /* تحسين مظهر الجداول */
        .table {
            color: white !important;
        }

        .table thead th {
            background-color: #0f3460 !important;
            border-color: #0f3460 !important;
            color: white !important;
        }

        .table tbody tr {
            background-color: #16213e !important;
        }

        .table tbody tr:hover {
            background-color: #0f3460 !important;
        }

        .table td {
            border-color: #0f3460 !important;
        }
        @media (max-width: 768px) {
    .navbar-toggler {
        margin-left: auto;
        margin-right: 0;
        display: block;
    }
}

.sidebar-btn, .submenu-btn {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-btn i, .submenu-btn i {
    margin: 0 !important;
    width: 20px;
    text-align: center;
}
.sidebar {
    overflow-x: hidden;
}


    </style>
<link href="{{ asset('css/dashboard-dark.css') }}" rel="stylesheet">


</head>

<body id="page-top">
    <div id="wrapper">
        <button id="sidebarToggle" class="btn bg-dark d-lg-none text-white" style="position: fixed; top: 10px; left: 10px; z-index: 1000;">
                <i class="fa fa-bars"></i>
            </button>
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
            style="min-height: 100vh; padding-top: 10px; background-color: rgb(9, 9, 71)">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon">
                    <img alt="Logo" class="rounded-circle logo__image" width="50" height="50"
                        src="{{ asset('adminProfile/laravel.jpg') }}">
                </div>
                <span class="logo__text text-white text-lg ml-2">{{ __('messages.pos_system') }}</span>

            </a>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a href="{{ route('adminDashboard') }}" class="sidebar-btn">
                    <i class="fas fa-home me-2"></i>{{ __('messages.dashboard') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="sidebar-btn" href="{{ route('category.index') }}">
                    <i class="fas fa-th-list me-2"></i>{{ __('messages.categories') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="sidebar-btn" href="{{ route('product.index') }}">
                    <i class="fas fa-box me-2"></i>{{ __('messages.products') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-btn" href="{{ route('order.index') }}">
                    <i class="fas fa-shopping-cart me-2"></i>{{ __('messages.orders') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="sidebar-btn" href="{{ route('saleInfoList') }}">
                    <i class="fas fa-chart-line me-2"></i>{{ __('messages.sales') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="sidebar-btn ml-0" href="{{ route('payment.index') }}">
                    <i class="fa-solid fa-dollar-sign me-2"></i>{{ __('messages.payments') }}
                </a>
            </li>

            @if (auth()->user()->role == 'superadmin')
            <li class="nav-item flex-column">
                <!-- Main Manage Users Menu -->
                <a class="sidebar-btn toggle-submenu ml-0" href="#">

                    <i class="fa-solid fa-users"></i>{{ __('messages.manage_users') }}
                </a>
                <!-- Submenu (Hidden by Default) -->
                <ul class="submenu list-unstyled ms-2" style="display: none;">
                    <li class="nav-item mb-2">
                        <a class="submenu-btn bg-dark text-white" href="{{ route('createAdminAccount') }}">
                            <i class="fa-solid fa-users"></i> {{ __('messages.add_new_admin') }}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="submenu-btn bg-dark text-white" href="{{ route('resetPasswordPage') }}">
                            <i class="fas fa-lock fa-sm fa-fw"></i> {{ __('messages.reset_password') }}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="submenu-btn bg-dark text-white" href="{{ route('role.userList') }}">
                            <i class="fa-solid fa-user-tie"></i> {{ __('messages.profile_info') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="nav-item flex-column">
                <!-- Main Reports Menu -->
                <a class="sidebar-btn text-start mb-2 toggle-submenu ml-0" href="#">

                    <i class="fa-solid fa-magnifying-glass-chart"></i>{{ __('messages.reports') }}
                </a>
                <!-- Submenu (Hidden by Default) -->
                <ul class="submenu list-unstyled ms-3" style="display: none;">
                    <li class="nav-item mb-2">
                        <a class="submenu-btn sidebar-btn bg-dark text-white" href="{{ route('salesReportPage') }}">
                            <i class="fa-solid fa-chart-bar"></i> {{ __('messages.sales_report') }}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="submenu-btn sidebar-btn bg-dark text-white" href="{{ route('productReportPage') }}">
                            <i class="fa-solid fa-chart-bar"></i> {{ __('messages.product_report') }}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="submenu-btn sidebar-btn bg-dark text-white" href="{{ route('profitlossreportpage') }}">
                            <i class="fa-solid fa-chart-bar"></i> {{ __('messages.profit_loss_report') }}
                        </a>
                    </li>
                </ul>
            </li>
            <hr class="sidebar-divider my-2">

            <li class="nav-item">
                <a class="sidebar-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('messages.logout') }}
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper"  style="background-color: #1a1a2e;">
            <!-- Main Content -->
            <div id="content" >
                <!-- Topbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-4 px-3" >
                    <!-- Navbar toggler (for mobile view) -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
                        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarContent" >
                        <ul class="navbar-nav">
                            <!-- زر تغيير اللغة بشكل متوافق مع Bootstrap 4 وقبل قائمة المستخدم -->
                            <li class="nav-item dropdown mr-5 mt-2">
                                <a class="btn btn-outline-secondary dropdown-toggle" href="#" id="langDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="langDropdown">
                                    <a class="dropdown-item" href="{{ route('changeLanguage', 'ar') }}">العربية</a>
                                    <a class="dropdown-item" href="{{ route('changeLanguage', 'en') }}">English</a>
                                </div>
                            </li>
                            <!-- User Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="mr-2 text-dark">
                                        @if (auth()->user()->name != null)
                                            {{ auth()->user()->name }}
                                        @else
                                            {{ auth()->user()->nickname }}
                                        @endif
                                    </span>
                                    <img class="rounded-circle" width="40" height="40"
                                        src="{{ auth()->user()->profile ? asset('adminProfile/' . auth()->user()->profile) : asset('admin/img/undraw_profile.svg') }}">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('profileDetails') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>{{ __('messages.profile') }}
                                    </a>
                                    @if (auth()->user()->role == 'superadmin')
                                        <a class="dropdown-item" href="{{ route('createAdminAccount') }}">
                                            <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-600"></i>{{ __('messages.add_admin') }}
                                        </a>
                                    @endif
                                    @if (auth()->user()->provider == 'simple')
                                        <a class="dropdown-item" href="{{ route('passwordChange') }}">
                                            <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-600"></i>{{ __('messages.change_password') }}
                                        </a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-link dropdown-item text-danger">{{ __('messages.logout') }}</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End of Topbar -->

                @yield('content')
                @include('sweetalert::alert')

            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid copyright py-4" style=" background-color: #252836 !important; margin-top: auto;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <span class="text-light">© {{ __('messages.developed_by') }} <a class="border-bottom text-light" href="https://mohamedelghool671.github.io/My_Company_Website/" target="_blank">X Code</a> {{ __('messages.company') }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#sidebarToggle").click(function () {
              $(".sidebar").toggleClass("active");

    // إخفاء أو إظهار الزر حسب حالة السايد بار
    if ($(".sidebar").hasClass("active")) {
        $(this).hide(); // إخفاء الزر
    } else {
        $(this).show(); // إظهاره تاني لو تقفل
    }
            });

            // Ensure clicking outside closes sidebar
            $(document).click(function (event) {
                if (!$(event.target).closest(".sidebar, #sidebarToggle").length) {
        $(".sidebar").removeClass("active");
        $("#sidebarToggle").show(); // إرجاع الزر لو السايد بار اختفى
    }
            });

            // تمييز الصفحة النشطة في السايد بار
            var currentPath = window.location.pathname;
            $('.sidebar-btn').each(function() {
                var href = $(this).attr('href');
                if (href && currentPath.includes(href.split('/').pop())) {
                    $(this).css({
                        'background-color': 'rgba(255, 255, 255, 0.2)',
                        'border-left': '4px solid #e94560'
                    });
                }
            });
        });

        function loadFile(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.getElementById('output');

                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0])
        }

           // Toggle submenu Reports
            $(document).ready(function(){
            $(".toggle-submenu").click(function(e){
                e.preventDefault(); // Prevent default link action
                $(this).next(".submenu").slideToggle();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: '{{ __("messages.are_you_sure") }}',
                text: "{{ __('messages.you_wont_be_able_to_revert_this') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __("messages.yes_delete_it") }}',
                cancelButtonText: '{{ __("messages.cancel") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

</body>

@yield('js-section')

</html>
