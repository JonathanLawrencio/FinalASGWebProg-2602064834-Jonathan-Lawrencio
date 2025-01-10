@extends('layout.master')

<style>
    .card {
        max-width: 400px;
        margin: 0 auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        object-fit: contain;
        height: 200px;
        width: 100%;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .like-btn {
        color: #007bff;
        cursor: pointer;
    }

    .like-btn:hover {
        color: #0056b3;
    }

    .like-btn.active {
        color: #28a745; 
    }
</style>

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">{{ __('messages.customer_detail') }}</h2>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <!-- Menampilkan data customer -->
    <div class="card">
        <!-- Foto -->
        @if($customer->photo)
            <img src="{{ asset('storage/profile_photos/' . $customer->photo) }}" class="card-img-top" alt="{{ __('messages.profile_photo') }}">
        @else
            <img src="{{ asset('images/default-profile.png') }}" class="card-img-top" alt="{{ __('messages.default_photo') }}">
        @endif

        <div class="card-body">
            <h5 class="card-title text-center d-flex justify-content-between">
                {{ $customer->username }}

                <!-- Tombol Like -->
                @php
                    // Cek apakah customer ini sudah ada di wishlist
                    $isInWishlist = \App\Models\Wishlist::where('customer_id', session('customer_id'))
                        ->where('wishlist_customer_id', $customer->customer_id)
                        ->exists();
                @endphp

                <form action="{{ route('wishlist.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="wishlist_customer_id" value="{{ $customer->customer_id }}">
                    <button type="submit" class="btn btn-light like-btn {{ $isInWishlist ? 'active' : '' }}">
                        <i class="fas fa-thumbs-up"></i>
                    </button>
                </form>
            </h5>

            <p><strong>{{ __('messages.email') }}:</strong> {{ $customer->email }}</p>
            <p><strong>{{ __('messages.gender') }}:</strong> {{ __('messages.' . $customer->gender) }}</p>
            <p><strong>{{ __('messages.hobby') }}:</strong> {{ $customer->hobby }}</p>
            <p><strong>{{ __('messages.instagram') }}:</strong>
                <a href="https://instagram.com/{{ $customer->instagram }}"
                    target="_blank">{{ '@' . $customer->instagram }}</a>
            </p>
            <p><strong>{{ __('messages.phone') }}:</strong> {{ $customer->phone }}</p>
        </div>
    </div>
</div>
@endsection
