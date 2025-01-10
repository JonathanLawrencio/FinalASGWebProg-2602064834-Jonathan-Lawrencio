@extends('layout.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">{{ __('messages.character_store') }}</h2>

    <ul class="nav nav-pills justify-content-center mt-4">
        <li class="nav-item">
            <a href="{{ route('avatars.index', ['tab' => 'store']) }}"
                class="nav-link {{ $tab === 'store' ? 'active' : '' }}">{{ __('messages.store') }}</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('avatars.index', ['tab' => 'collection']) }}"
                class="nav-link {{ $tab === 'collection' ? 'active' : '' }}">{{ __('messages.collection') }}</a>
        </li>
    </ul>

    <!-- Flash Messages placed below navigation -->
    <div class="mt-4">
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="mt-4">
        @if($tab === 'store')
            <div class="row">
                @foreach($availableAvatars as $avatar)
                    <div class="col-md-4 col-lg-3 text-center mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ asset($avatar->image_path) }}" alt="{{ $avatar->name }}" class="card-img-top rounded">
                            <div class="card-body">
                                <h5 class="card-title">{{ $avatar->name }}</h5>
                                <p class="text-muted"><strong>{{ $avatar->price }} {{ __('messages.coins') }}</strong></p>
                                @if(session('is_logged_in'))
                                    <form action="{{ route('avatars.purchase') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="avatar_id" value="{{ $avatar->avatar_id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.buy') }}</button>
                                    </form>
                                @else
                                    <a href="{{ route('login.form') }}" class="btn btn-secondary btn-sm">{{ __('messages.login_to_buy') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($tab === 'collection')
            @if($purchasedAvatars->isEmpty())
                <p class="text-muted text-center mt-4">{{ __('messages.no_purchased_avatars') }}</p>
            @else
                <div class="row">
                    @foreach($purchasedAvatars as $avatar)
                        <div class="col-md-4 col-lg-3 text-center mb-4">
                            <div class="card shadow-sm">
                                <img src="{{ asset($avatar->image_path) }}" alt="{{ $avatar->name }}" class="card-img-top rounded">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $avatar->name }}</h5>
                                    @if($customer->is_hidden)
                                        <button class="btn btn-secondary btn-sm" disabled>{{ __('messages.cannot_equip_hidden') }}</button>
                                    @else
                                        <form action="{{ route('avatars.equip') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="avatar_id" value="{{ $avatar->avatar_id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.equip') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
