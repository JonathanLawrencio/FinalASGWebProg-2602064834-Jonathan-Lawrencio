@extends('layout.master')

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
        max-height: 200px;
        width: 100%;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 10px;
    }

    .card-link {
        color: inherit;
        text-decoration: none;
    }
</style>

@section('content')
<div class="container mt-5">
    <!-- Pencarian -->
    <div class="mb-4">
        <form action="{{ route('home') }}" method="GET" class="d-flex justify-content-between align-items-center mb-3">
            <!-- Kolom Pencarian -->
            <div class="d-flex align-items-center flex-grow-1 me-3">
                <input type="text" name="hobby" class="form-control" placeholder="{{ __('messages.search_by_hobby') }}" 
                       value="{{ request('hobby') }}" 
                       style="width: 100%; max-width: 800px;"> <!-- Lebarkan kolom pencarian -->
                <button type="submit" class="btn btn-primary ms-2">{{ __('messages.search') }}</button>
            </div>
            <!-- Filter Gender -->
            <div class="d-flex align-items-center">
                <label for="gender" class="me-2">{{ __('messages.filter_by_gender') }}:</label>
                <select name="gender" id="gender" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                    <option value="">{{ __('messages.all') }}</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Menampilkan Foto dan Data Customer -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach($customers as $customer)
            @if(!$customer->is_hidden) <!-- Tampilkan hanya jika profil tidak disembunyikan -->
                <div class="col d-flex">
                    <a href="{{ route('customer.detail', ['id' => $customer->customer_id]) }}" class="card-link w-100">
                        <div class="card">
                            @if($customer->photo)
                                <img src="{{ asset('storage/profile_photos/' . $customer->photo) }}" class="card-img-top" alt="Profile Photo">
                            @else
                                <img src="{{ asset('images/default-profile.png') }}" class="card-img-top" alt="Default Photo">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $customer->username }}</h5>
                                <p class="card-text">
                                    <strong>{{ __('messages.hobby') }}:</strong>
                                    @php
                                        $hobbies = explode(',', $customer->hobby);
                                        $limitedHobbies = array_slice($hobbies, 0, 3);
                                        $hobbyDisplay = implode(', ', $limitedHobbies);
                                    @endphp
                                    {{ $hobbyDisplay }}
                                    @if(count($hobbies) > 3)
                                        ...
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach

        <!-- Jika tidak ada customer -->
        @if($customers->isEmpty())
            <div class="col-12 text-center">
                <p class="text-muted">{{ __('messages.no_customers_found') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
