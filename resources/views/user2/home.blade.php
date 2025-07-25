@extends('user2.layouts.master')

@section('content')
  <!-- Slider Section -->
  <section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    {{ __('messages.quality_of_service') }}
                  </h1>
                  <p>
                    {{ __('messages.welcome_message') }}
                  </p>
                  <div class="btn-box">
                    <a href="{{ route('shopList') }}" class="btn1">
                      {{ __('messages.shop') }}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
        </ol>
      </div>
    </div>
  </section>
  <!-- end slider section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.our_products_services') }}</h2>
      </div>
      <!-- فلاتر التصنيفات -->
      <ul class="filters_menu">
        <li class="{{ request('category_id') ? '' : 'active' }}">
          <a href="{{ route('shopList') }}">{{ __('messages.all_categories') }}</a>
        </li>
        @foreach ($category as $item)
          <li class="{{ request('category_id') == $item->id ? 'active' : '' }}">
            <a href="{{ route('shopList', $item->id) }}">{{ $item->name }}</a>
          </li>
        @endforeach
      </ul>
      <div class="filters-content">
        <div class="row grid">
          @foreach ($products as $item)
          <div class="col-sm-6 col-lg-4 all">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('productImages/' . $item->image) }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>{{ $item->name }}</h5>
                  <p>{{ Str::words($item->description, 10, '...') }}</p>
                  <div class="options">
                    <h6>{{ $item->price }} MMK</h6>
                    <form action="{{ route('addToCart') }}" method="POST" style="display:inline;">
                      @csrf
                      <input type="hidden" name="productID" value="{{ $item->id }}">
                      <input type="hidden" name="qty" value="1">
                      <button type="submit" style="background: none; border: none; padding: 0;">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="width:32px;height:32px;fill:#ffbe33;" xml:space="preserve">
                          <g>
                            <g>
                              <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                           c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                           C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                           c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                           C457.728,97.71,450.56,86.958,439.296,84.91z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                           c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                            </g>
                          </g>
                        </svg>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
