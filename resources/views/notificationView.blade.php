@extends('layout.master')

@section('content')
<div class="container mt-5">
    <h2>{{ __('messages.notifications') }}</h2>
    <div class="list-group">
        @forelse($notifications as $notification)
            <div class="list-group-item">
                <p>{{ $notification->message }}</p>
                <small>{{ __('messages.sent_by') }}: {{ $notification->sender->username }}</small>
                <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p class="text-center">{{ __('messages.no_notifications') }}</p>
        @endforelse
    </div>
</div>
@endsection
