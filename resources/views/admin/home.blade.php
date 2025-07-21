@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
            <div class="row g-3">

                <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                    <div class="card border-left-warning shadow h-80 d-flex flex-column" data-toggle="modal" data-target="#outOfStockModal" style="cursor: pointer;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        {{ __('messages.products_out_of_stock') }}
                                    </div>

                                    @if($outofstock->isNotEmpty())
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ __('messages.items') }}: {{ $outofstock->count() }}
                                        </div>
                                    @else
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            0
                                        </div>
                                    @endif

                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x fa-layer-group"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- to show details -->
                <div class="modal fade" id="outOfStockModal" tabindex="-1" aria-labelledby="outOfStockModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="outOfStockModalLabel">{{ __('messages.almost_out_of_stock') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if($outofstock->isNotEmpty())
                                <ul class="list-group">
                                    @foreach($outofstock as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $item->name }}
                                            <span class="badge badge-warning">{{ $item->stock }} {{ __('messages.left') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center text-muted">{{ __('messages.no_products_low') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                <a href="{{ route('category.index') }}" class="text-decoration-none">
                <div class="card border-left-secondary shadow h-80 d-flex flex-column categoryList">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    {{ __('messages.category_count') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="category-count" data-count="{{ $categoryCount }}">0</div>

                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-2x fa-list"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                <div class="card border-left-success shadow h-80 d-flex flex-column">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    {{ __('messages.payment_type') }}</div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="payment-count" data-count="{{ $pendingOrders }}">0</div>

                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-2x fa-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                <a href="{{ route('role.index') }}" class="text-decoration-none">
                    <div class="card border-left-primary shadow h-80 d-flex flex-column adminList">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('messages.admin_account') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="admin-count" data-count="{{ $adminCount }}">0</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x fa-user-shield"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
            </div>

        </div>

        <!-- Content Row -->

        <div class="row g-3">
            <!-- Pending Requests Card -->
            <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                <a href="{{ route('order.index') }}" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-80 d-flex flex-column pendingList">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        {{ __('messages.pending_requests') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="orderpending-count" data-count="{{ $orderPending }}">0</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-2x fa-comment-dots"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Sales Card -->
            <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                <div class="card border-left-secondary shadow h-80 d-flex flex-column">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    {{ __('messages.total_sale') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_sale-count" data-count="{{ $total_sale_amt }}">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-2x fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                <div class="card border-left-success shadow h-80 d-flex flex-column">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    {{ __('messages.request_success') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="ordersuccess-count" data-count="{{ $orderSuccess }}">0</div>
                            </div>
                            <div class="col-auto">

                                <i class="fa-solid fa-2x fa-circle-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                <a href="{{ route('role.userList') }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-80 d-flex flex-column customerList">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ __('messages.customer_account') }}</div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="user-count" data-count="{{ $userCount }}">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-2x fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>

        <!-- Chart -->
        <div class="row g-3">
            <div class="col-xl-8 col-lg-7 col-sm-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.sales_overview') }}</h6>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5 col-sm-12">
                <div class="bg-white mb-4" style="height: 395px;">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.top_selling_products') }}</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="chartTypeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-chart-pie"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chartTypeDropdown">
                                <a class="dropdown-item chart-type-btn" href="#" data-type="pie">
                                    <i class="fas fa-chart-pie"></i> {{ __('messages.pie_chart') }}
                                </a>
                                <a class="dropdown-item chart-type-btn" href="#" data-type="bar">
                                    <i class="fas fa-chart-bar"></i> {{ __('messages.bar_chart') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-2 pb-2">
                            <canvas id="productSalesChart" width="300" height="260"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-section')

    <script>
        //  <!-- Sales overview chart -->
        document.addEventListener("DOMContentLoaded", function() {
            let salesData = @json($salesOverview);

            let labels = salesData.map(item => item.date);
            let data = salesData.map(item => item.daily_sales);

            var ctx = document.getElementById("myAreaChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "{{ __('messages.daily_sales') }}",
                        data: data,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: '{{ app()->getLocale() == "ar" ? "التاريخ" : "Date" }}'
                            }
                        },
                        y: {
                            display: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: '{{ app()->getLocale() == "ar" ? "المبيعات" : "Sales" }}'
                            }
                        }
                    },
                    elements: {
                        point: {
                            radius: 4,
                            hoverRadius: 6
                        },
                        line: {
                            tension: 0.4
                        }
                    }
                }
            });
        });


// Product Sales Chart with type switching
        document.addEventListener("DOMContentLoaded", function(){
            let productSalesData = @json($topProducts);
            let labels = productSalesData.map(item => item.product_name);
            let data = productSalesData.map(item => item.total_sold);

            // للتأكد من البيانات
            console.log('Product Sales Data:', productSalesData);
            console.log('Labels:', labels);
            console.log('Data:', data);

            let currentChartType = 'pie';
            let productChart = null;

            function createChart(type) {
                const ctx = document.getElementById("productSalesChart").getContext('2d');

                // Destroy existing chart if it exists
                if (productChart) {
                    productChart.destroy();
                }

                // للتأكد من البيانات عند إنشاء الرسم البياني
                console.log('Creating chart type:', type);
                console.log('Labels for chart:', labels);
                console.log('Data for chart:', data);

                const chartConfig = {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FF6384', '#36A2EB'],
                            borderColor: type === 'bar' ? ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FF6384', '#36A2EB'] : undefined,
                            borderWidth: type === 'bar' ? 2 : undefined
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: 'white',
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        },
                        scales: type === 'bar' ? {
                            x: {
                                display: true,
                                ticks: {
                                    color: 'white',
                                    font: {
                                        size: 11
                                    },
                                    maxRotation: 45,
                                    minRotation: 0
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            },
                            y: {
                                display: true,
                                beginAtZero: true,
                                ticks: {
                                    color: 'white',
                                    font: {
                                        size: 11
                                    }
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            }
                        } : undefined
                    }
                };

                productChart = new Chart(ctx, chartConfig);
            }

            // Initialize with pie chart
            createChart('pie');

            // Handle chart type switching
            document.querySelectorAll('.chart-type-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const type = this.dataset.type;
                    currentChartType = type;

                    // Update dropdown button icon
                    const dropdownBtn = document.getElementById('chartTypeDropdown');
                    const icon = dropdownBtn.querySelector('i');
                    icon.className = type === 'pie' ? 'fas fa-chart-pie' : 'fas fa-chart-bar';

                    // Create new chart
                    createChart(type);
                });
            });
        });

        // Card data count
        document.addEventListener("DOMContentLoaded", function() {
            let countElements = document.querySelectorAll("[data-count]");

            countElements.forEach((element) => {
                let count = 0;
                let target = parseInt(element.dataset.count);

                let counter = setInterval(() => {
                    if (count < target) {
                        count += Math.ceil(target / 100); // Adjust speed
                        element.innerText = count;
                    } else {
                        element.innerText = target;
                        clearInterval(counter);
                    }
                }, 100); // Speed of counting
            });
        });

        //Admin list card route to adminlist page
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".adminList").addEventListener("click", function() {
                window.location.href = "{{ route('role.index') }}";
            });
        });

        //Route to customerList page
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".customerList").addEventListener("click", function() {
                window.location.href = "{{ route('role.userList') }}";
            });
        });


        //Route to Category List page
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".categoryList").addEventListener("click", function() {
                window.location.href = "{{ route('category.index') }}";
            });
        });


        //Route to order list page
        document.addEventListener("DOMContentLoaded", function(){
            document.querySelector(".pendingList").addEventListener("click", function(){
                window.location.href = "{{ route('order.index') }}";
            });
        });

    </script>
@endsection
