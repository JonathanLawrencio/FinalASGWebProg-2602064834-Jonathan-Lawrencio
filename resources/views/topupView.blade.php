@extends('layout.master')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card" style="width: 350px; padding: 20px;">
        <h4 class="text-center mb-4">{{ __('messages.topup_coins') }}</h4>
        <p class="text-center">{{ __('messages.current_coins') }}: <strong>{{ $currentCoins }}</strong></p>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Form Top-Up -->
        <form action="{{ route('coins.topup.process') }}" method="POST" class="text-center">
            @csrf
            <input type="hidden" name="topup_amount" value="100"> <!-- Set jumlah top-up langsung ke 100 -->
            <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">{{ __('messages.topup_100_coins') }}</button>
        </form>
    </div>
</div>
@endsection
