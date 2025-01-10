@extends('layout.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ __('messages.my_profile') }}</h2>

    <!-- Flash Message -->
    @if(session('success'))
    <div class="alert alert-success">{{ __('messages.profile_photo_updated_successfully') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ __('messages.not_enough_coins') }}</div>
    @endif

    <!-- Display Profile Photo -->
    <div class="card mb-4">
        <div class="card-body text-center">
            <h5 class="card-title">{{ __('messages.profile_photo') }}</h5>
            <div class="mb-3">
                <style>
                    .profile-photo {
                        width: 150px;
                        height: 150px;
                        border-radius: 50%;
                        object-fit: cover;
                        background-color: #f8f9fa;
                    }
                </style>
                @if($customer->photo)
                    <img src="{{ asset('storage/profile_photos/' . $customer->photo) }}" alt="{{ __('messages.profile_photo') }}"
                        class="profile-photo">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="{{ __('messages.default_profile_photo') }}" class="profile-photo">
                @endif
            </div>
            <!-- Display Username -->
            <h5>{{ $customer->username }}</h5>

            <!-- Form Update Photo -->
            <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="photo">{{ __('messages.upload_new_photo') }}</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('messages.update_photo') }}</button>
            </form>

            <!-- Hide/Unhide Profile Button -->
            @if(!$customer->is_hidden)
                <form action="{{ route('profile.hide') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-warning">{{ __('messages.hide_profile') }} (50 {{ __('messages.coins') }})</button>
                </form>
            @else
                <form action="{{ route('profile.unhide') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-success">{{ __('messages.unhide_profile') }} (5 {{ __('messages.coins') }})</button>
                </form>
            @endif

        </div>
    </div>

    <!-- Friend List -->
    <h4 class="mt-4">{{ __('messages.friend_list') }}</h4>
    <div class="card">
        <div class="card-body">
            @if($friends->isEmpty())
                <p class="text-center">{{ __('messages.no_friends') }}</p>
            @else
                @foreach($friends as $friend)
                    <div class="d-flex align-items-center justify-content-between mb-3 p-2"
                        style="border-bottom: 1px solid #ddd;">
                        <!-- Profile Picture and Name -->
                        <div class="d-flex align-items-center">
                            <img src="{{ $friend->photo ? asset('storage/profile_photos/' . $friend->photo) : asset('images/default-profile.png') }}"
                                alt="{{ __('messages.friend_profile') }}" class="rounded-circle"
                                style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;">
                            <h5 class="mb-0">{{ $friend->username }}</h5>
                        </div>
                        <!-- Remove Friend Button -->
                        <form action="{{ route('friend.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="friend_id" value="{{ $friend->customer_id }}">
                            <button type="submit" class="btn btn-light like-btn">
                                <i class="fas fa-thumbs-down text-danger"></i> <!-- Font Awesome Icon -->
                                {{ __('messages.remove_friend') }}
                            </button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
