<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <span class="navbar-brand">ConnectFriend</span>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{__('messages.home')}}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('wishlist.index') }}">{{__('messages.wishlist')}}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}">{{__('messages.notifications')}}</a></li>

        <!-- Dropdown for Avatars -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('avatars.index', ['tab' => 'store']) }}">{{__('messages.avatars')}}</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto align-items-center">
        @if(session('is_logged_in'))
        <!-- Coins -->
        <li class="nav-item me-3">
          <a href="{{ route('coins.topup') }}" class="nav-link">{{__('messages.coins')}}:
            <strong>
              {{ \App\Models\Customer::where('customer_id', session('customer_id'))->value('coin') }}
            </strong>
          </a>
        </li>
        @endif

        <!-- Language Selection -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{__('messages.language')}}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('change.language', ['locale' => 'en']) }}">English</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('change.language', ['locale' => 'id']) }}">Bahasa Indonesia</a>
            </li>
          </ul>
        </li>

        @if(session('is_logged_in'))
        <!-- Profile -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile.show') }}">
            @php
            $profilePhoto = \App\Models\Customer::where('customer_id', session('customer_id'))->value('photo');
            @endphp
            @if($profilePhoto)
            <img src="{{ asset('storage/profile_photos/' . $profilePhoto) }}" alt="Profile Photo" class="rounded-circle"
              style="width: 30px; height: 30px; object-fit: cover;">
            @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Photo" class="rounded-circle"
              style="width: 30px; height: 30px; object-fit: cover;">
            @endif
          </a>
        </li>

        <!-- Logout -->
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-link nav-link">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </form>
        </li>
        @else
        <!-- Profile (direct to login if not logged in) -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login.form') }}">
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Photo" class="rounded-circle"
              style="width: 30px; height: 30px; object-fit: cover;">
          </a>
        </li>

        <!-- Login Button -->
        <li class="nav-item"><a class="btn btn-primary btn-sm" href="{{ route('login.form') }}">{{__('messages.login')}}</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
