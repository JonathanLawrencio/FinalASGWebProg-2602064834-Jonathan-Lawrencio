@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">{{ __('messages.create_account') }}</h4>

                    <!-- Menampilkan Pesan Sukses -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <!-- Username -->
                        <div class="form-group mb-3">
                            <label for="username">{{ __('messages.username') }}</label>
                            <input type="text"
                                class="form-control @error('username') is-invalid @enderror"
                                id="username"
                                name="username"
                                placeholder="{{ __('messages.enter_username') }}"
                                value="{{ old('username') }}">
                            @error('username')
                            <span class="text-danger">{{ __('messages.validation.username required') }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email">{{ __('messages.email') }}</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                placeholder="{{ __('messages.enter_email') }}"
                                value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ __('messages.validation.email_required') }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password">{{ __('messages.password') }}</label>
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="{{ __('messages.enter_password') }}">
                            @error('password')
                            <span class="text-danger">{{ __('messages.validation.password required') }}</span>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="form-group mb-3">
                            <label for="gender">{{ __('messages.gender') }}</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option value="">{{ __('messages.select_gender') }}</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{ __('messages.validation.gender_required') }}</span>
                            @enderror
                        </div>

                        <!-- Hobby -->
                        <div class="form-group mb-3">
                            <label for="hobby">{{ __('messages.hobby') }} ({{ __('messages.min_3') }})</label>
                            @for ($i = 0; $i < 3; $i++)
                                <input type="text"
                                class="form-control mb-2 @error('hobby.' . $i) is-invalid @enderror"
                                name="hobby[]"
                                placeholder="{{ __('messages.enter_hobby') }}"
                                value="{{ old('hobby.' . $i) }}">
                                @error('hobby.' . $i)
                                <span class="text-danger">{{ __('messages.validation.hobby_required') }}</span>
                                @enderror
                            @endfor
                            <div id="extraHobbies"></div>
                            <button type="button" class="btn btn-secondary mt-2" id="addHobby">+</button>
                        </div>

                        <!-- Instagram -->
                        <div class="form-group mb-3">
                            <label for="instagram">{{ __('messages.instagram') }}</label>
                            <input type="text"
                                class="form-control @error('instagram') is-invalid @enderror"
                                id="instagram"
                                name="instagram"
                                placeholder="http://www.instagram.com/username"
                                value="{{ old('instagram') }}">
                            @error('instagram')
                            <span class="text-danger">{{ __('messages.validation.instagram_required') }}</span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group mb-3">
                            <label for="phone">{{ __('messages.phone') }}</label>
                            <input type="text"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="phone"
                                name="phone"
                                placeholder="{{ __('messages.enter_phone') }}"
                                value="{{ old('phone') }}">
                            @error('phone')
                            <span class="text-danger">{{ __('messages.validation.phone_required') }}</span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-3">
                            <label for="price">{{ __('messages.price') }}</label>
                            <input type="text"
                                class="form-control"
                                id="price"
                                name="price"
                                value="{{ old('price', $price) }}"
                                readonly>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script to dynamically add more hobby input fields
    document.getElementById('addHobby').addEventListener('click', function() {
        const extraHobbies = document.getElementById('extraHobbies');
        const newHobbyInput = document.createElement('input');
        newHobbyInput.type = 'text';
        newHobbyInput.className = 'form-control mt-2';
        newHobbyInput.name = 'hobby[]';
        newHobbyInput.placeholder = '{{ __("messages.enter_hobby") }}';
        extraHobbies.appendChild(newHobbyInput);
    });
</script>
@endsection
