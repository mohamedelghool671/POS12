<header class="header_section">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="{{ route('userDashboard') }}">
        <span>
          Feane
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  mx-auto ">
          <li class="nav-item {{ request()->routeIs('userDashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('userDashboard') }}">{{ __('messages.home') }}</a>
          </li>
          <li class="nav-item {{ request()->routeIs('shopList') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('shopList') }}">{{ __('messages.shop') }}</a>
          </li>
          <li class="nav-item {{ request()->routeIs('contactUs') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('contactUs') }}">{{ __('messages.contact') }}</a>
          </li>
        </ul>
        <div class="user_option d-flex align-items-center gap-3">
          <a href="{{ route('changeLanguage', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="btn btn-outline-secondary">
            {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}
          </a>
          <a href="{{ route('userProfileDetails') }}" class="user_link">
            <i class="fa fa-user" aria-hidden="true"></i>
          </a>
          <a class="cart_link" href="{{ route('cart') }}">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            @if(isset($cartCount) && $cartCount > 0)
              <span class="badge bg-danger">{{ $cartCount }}</span>
            @endif
          </a>
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button class="btn btn-warning px-3" type="submit">{{ __('messages.logout') }}</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
</header>
