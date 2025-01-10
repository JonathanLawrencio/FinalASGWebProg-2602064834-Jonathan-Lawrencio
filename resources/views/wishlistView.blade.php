@extends('layout.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">{{ __('messages.wishlist_title') }}</h2>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <style>
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
            color: #dc3545;
        }
    </style>

    <!-- Menampilkan Daftar Wishlist -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @forelse($wishlists as $wishlist)
            <div class="col">
                <div class="card">
                    <!-- Foto -->
                    @if($wishlist->photo)
                        <img src="{{ asset('storage/profile_photos/' . $wishlist->photo) }}" class="card-img-top" alt="{{ __('messages.profile_photo') }}">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" class="card-img-top" alt="{{ __('messages.default_photo') }}">
                    @endif

                    <!-- Informasi Customer -->
                    <div class="card-body">
                        <h5 class="card-title text-center d-flex justify-content-between align-items-center">
                            {{ $wishlist->username }}
                            <!-- Tombol Thumb -->
                            <form action="{{ route('wishlist.remove') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="wishlist_customer_id" value="{{ $wishlist->customer_id }}">
                                <button type="submit" class="btn btn-light like-btn">
                                    <i class="fas fa-thumbs-up text-danger"></i>
                                </button>
                            </form>
                        </h5>
                        <p><strong>{{ __('messages.email') }}:</strong> {{ $wishlist->email }}</p>
                        <p><strong>{{ __('messages.gender') }}:</strong> {{ $wishlist->gender }}</p>
                        <p><strong>{{ __('messages.hobby') }}:</strong> {{ $wishlist->hobby }}</p>
                        <p><strong>{{ __('messages.instagram') }}:</strong>
                            <a href="https://instagram.com/{{ $wishlist->instagram }}" target="_blank">{{ '@' . $wishlist->instagram }}</a>
                        </p>
                        <p><strong>{{ __('messages.phone') }}:</strong> {{ $wishlist->phone }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">{{ __('messages.wishlist_empty') }}</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
