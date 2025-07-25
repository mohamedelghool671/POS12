@extends('user.layouts.master')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ __('messages.shop') }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{route('userDashboard')}}">{{ __('messages.home') }}</a></li>
            <li class="breadcrumb-item "><a href="#">{{ __('messages.pages') }}</a></li>
            <li class="breadcrumb-item active text-white">{{ __('messages.shop') }}</li>
        </ol>
    </div>
    <!-- Single Page Header end -->

    <!-- Shop Start-->
    <div class="container-fluid products">
        <div class="container py-3">
            <h1 class="mb-3 text-white">{{ __('messages.choose_your_flowers') }}</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <form action="{{ route('shopList') }}" method="get">
                                @csrf
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" value="{{ request('searchKey') }}"
                                        name="searchKey" placeholder="{{ __('messages.search_by_keyword') }}">
                                    <button type="submit" class="input-group-text p-3"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4 class="text-white">{{ __('messages.categories') }}</h4>
                                            <ul class="text-white list-unstyled products-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between products-name ">
                                                        <a href="{{ route('shopList') }}"><i class="fa-solid fa-clover"></i>
                                                            {{ __('messages.all_categories') }}</a>
                                                    </div>
                                                </li>
                                                @foreach ($categories as $item)
                                                    <li>
                                                        <div class="d-flex justify-content-between products-name">
                                                            <a href="{{ route('shopList', $item->id) }}"><i class="fa-solid fa-clover"></i> {{ $item->name }}</a>
                                                            {{-- <span>(3)</span> --}}
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <form action="{{ route('shopList') }}" method="get">
                                            @csrf
                                            <p class="text-white">{{ __('messages.price') }}</p>
                                            <input type="text" name="minPrice" value="{{ request('minPrice') }}"
                                                class="form-control my-2" placeholder="{{ __('messages.minimum') }}">
                                            <input type="text" name="maxPrice" value="{{ request('maxPrice') }}"
                                                class="form-control my-2" placeholder="{{ __('messages.maximum') }}">
                                            <input type="submit" class="btn-warning my-2" value="{{ __('messages.filter') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4">
                                    @foreach ($products as $item)
                                        <div class="col-md-6 col-lg-4 col-xl-4">
                                            <div class="rounded position-relative products-item" style="background: linear-gradient(135deg, #ffd700, #191970);">
                                                <div class="products-img">
                                                    <a href="{{ route('shopDetails', $item->id) }}">
                                                        <img style="height:250px"
                                                            src="{{ asset('productImages/' . $item->image) }}"
                                                            class="img-fluid w-100 rounded-top" alt="">
                                                    </a>
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">{{ $item->category_name }}</div>
                                                <div
                                                    class="p-4 text-white border border-secondary border-top-0 rounded-bottom">
                                                    <h4 class="text-white">{{ $item->name }}</h4>
                                                    <p>{{ Str::words($item->description, 10, '...') }}</p>

                                                    <div class="d-flex flex-lg-wrap">
                                                        <p class="text-white fs-5 fw-bold mb-2">{{ $item->price }}</p>
                                                        <form action="{{ route('addToCart') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="productID" value="{{ $item->id }}">
                                                            <input type="hidden" name="qty" value="1"> <!-- Default quantity -->
                                                            <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> {{ __('messages.add_to_cart') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                    <div class="col-12 d-flex justify-content-center mt-4">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-center flex-wrap gap-2">
                                                {{-- Previous Page Link --}}
                                                @if ($products->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link">‹</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">‹</a></li>
                                                @endif
                                    
                                                {{-- Pagination Elements --}}
                                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                                    @if ($page == $products->currentPage())
                                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                    
                                                {{-- Next Page Link --}}
                                                @if ($products->hasMorePages())
                                                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">›</a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link">›</span></li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                    
                                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop End-->

        <!-- Back to Top -->
        <a href="#" class="btn border-3 border-primary rounded-circle back-to-top"><i
                class="fa fa-arrow-up"></i></a>
    @endsection
