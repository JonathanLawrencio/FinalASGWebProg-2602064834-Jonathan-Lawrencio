@extends('layout.master')

@section('content')
<div class="container mt-5">
    <h2>Payment Successful</h2>
    <p>Your registration is successful!</p>
    <p>If you overpaid, your coins have been added to your account.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
</div>
@endsection
