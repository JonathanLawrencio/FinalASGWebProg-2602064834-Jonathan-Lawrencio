@extends('layout.master')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>

    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center">{{ __('messages.form_title') }}</h2>
            <p class="text-center">{{ __('messages.registration_fee') }}: <strong>{{ $price }}</strong></p>

            <!-- Error Message -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ __('messages.payment_error') }}
            </div>
            @endif


            <!-- Overpaid Logic -->
            @if(session('overpaid'))
            <div class="alert alert-warning">
                {{ __('messages.overpaid_message', ['amount' => session('overpaid_amount')]) }}
            </div>
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="paid_amount"
                    value="{{ old('paid_amount', $price + session('overpaid_amount', 0)) }}">
                <div class="form-group mb-3">
                    <p>{{ __('messages.overpaid_question') }}</p>
                    <div class="d-flex gap-2 justify-content-start">
                        <button type="submit" name="decision" value="yes" class="btn btn-success btn-sm">{{ __('messages.yes') }}</button>
                        <button type="submit" name="decision" value="no" class="btn btn-danger btn-sm">{{ __('messages.no') }}</button>
                    </div>
                </div>
            </form>
            @else

            <!-- Form Input -->
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="paid_amount">{{ __('messages.amount_paid') }}</label>
                    <input type="number" class="form-control" id="paid_amount" name="paid_amount"
                        placeholder="{{ __('messages.enter_payment') }}" value="{{ old('paid_amount') }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('messages.submit') }}</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection