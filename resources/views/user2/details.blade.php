@extends('user2.layouts.master')

@section('content')
  <section class="details_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="{{ asset('productImages/' . $product->image) }}" class="img-fluid rounded mb-3" alt="Image">
        </div>
        <div class="col-md-6">
          <h3>{{ $product->name }}</h3>
          <p>{{ $product->category_name }}</p>
          <h4>{{ $product->price }} MMK</h4>
          <div class="mb-3">
            @php $stars = number_format($productRating); @endphp
            @for ($i = 1; $i <= $stars; $i++)
              <i class="fa fa-star text-warning"></i>
            @endfor
            @for ($j = $stars + 1; $j <= 5; $j++)
              <i class="fa fa-star"></i>
            @endfor
            <span class="ms-2">{{ $ratingCount->count() }} Ratings</span>
          </div>
          <p>{{ $product->description }}</p>
          <form action="{{ route('addToCart') }}" method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="productID" value="{{ $product->id }}">
            <div class="input-group mb-3" style="width: 120px;">
              <button type="button" class="btn btn-outline-secondary btn-minus"><i class="fa fa-minus"></i></button>
              <input type="text" name="qty" class="form-control text-center" value="1">
              <button type="button" class="btn btn-outline-secondary btn-plus"><i class="fa fa-plus"></i></button>
            </div>
            <button type="submit" class="btn btn-warning w-100" @if ($product->remaining_stock == 0) disabled @endif>
              <i class="fa fa-shopping-bag me-2"></i> {{ __('messages.add_to_cart') }}
            </button>
          </form>
          <form action="{{ route('addRating') }}" method="POST">
            @csrf
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ratingModal">
              {{ __('messages.rate_this_product') }}
            </button>
            <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">{{ __('messages.rating_products') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="star-icon">
                      @if ($user_Rating != 0)
                        @php $userRating =number_format($user_Rating) @endphp
                        @for ($i = 1; $i <= $userRating; $i++)
                          <input type="radio" value="{{ $i }}" name="productRating" checked id="rating{{ $i }}">
                          <label for="rating{{ $i }}" class="fa fa-star checked"></label>
                        @endfor
                        @for ($j = $userRating + 1; $j <= 5; $j++)
                          <input type="radio" value="{{ $j }}" name="productRating" id="rating{{ $j }}">
                          <label for="rating{{ $j }}" class="fa fa-star"></label>
                        @endfor
                      @else
                        @for ($i = 1; $i <= 5; $i++)
                          <input type="radio" value="{{ $i }}" name="productRating" id="rating{{ $i }}" @if($i==1) checked @endif>
                          <label for="rating{{ $i }}" class="fa fa-star"></label>
                        @endfor
                      @endif
                    </div>
                  </div>
                  <input type="hidden" name="productID" value="{{ $product->id }}">
                  <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12">
          <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="tab" href="#desc">{{ __('messages.description') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#reviews">{{ __('messages.reviews') }}</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="desc">
              <p>{{ $product->description }}</p>
            </div>
            <div class="tab-pane fade" id="reviews">
              @foreach ($comment as $item)
                <div class="d-flex mb-3">
                  @if ($item->userprofile != null)
                    <img src="{{ asset('userProfile/' . $item->userprofile) }}" class="img-fluid rounded-circle me-3" style="width: 60px; height: 60px;" alt="">
                  @else
                    <img src="{{ asset('admin/img/undraw_profile.svg') }}" class="img-fluid rounded-circle me-3" style="width: 60px; height: 60px;" alt="">
                  @endif
                  <div>
                    <h6>{{ $item->username }}</h6>
                    <small class="text-muted">{{ $item->created_at->format('j-F-y') }}</small>
                    <p>{{ $item->message }}</p>
                  </div>
                </div>
                <hr>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <form action="{{ route('comment') }}" method="post">
        @csrf
        <h4>{{ __('messages.leave_a_reply') }}</h4>
        <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
        <input type="hidden" name="productID" value="{{ $product->id }}">
        <div class="mb-3">
          <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="4" placeholder="{{ __('messages.write_your_message') }}">{{ old('message') }}</textarea>
          @error('message')
            <small class="invalid-feedback">{{ $message }}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-outline-primary">{{ __('messages.post_comment') }}</button>
      </form>
      <div class="mt-5">
        <h4>{{ __('messages.related_products') }}</h4>
        <div class="row">
          @foreach ($productList as $item)
            @if ($product->id != $item->id)
              <div class="col-md-3 mb-3">
                <div class="card h-100">
                  <img style="height:120px;object-fit:cover" src="{{ asset('productImages/' . $item->image) }}" class="card-img-top" alt="">
                  <div class="card-body">
                    <h6>{{ $item->name }}</h6>
                    <p class="fw-bold">{{ $item->price }} MMK</p>
                    <form action="{{ route('addToCart') }}" method="POST">
                      @csrf
                      <input type="hidden" name="productID" value="{{ $item->id }}">
                      <input type="hidden" name="qty" value="1">
                      <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="fa fa-shopping-bag me-2"></i> {{ __('messages.add_to_cart') }}
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
