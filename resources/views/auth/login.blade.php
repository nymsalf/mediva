 @extends('layouts.app')

@section('content')
<div class="w-full min-h-screen bg-white overflow-x-hidden">
    <div class="auth-page">
        <div class="login-card">

            <div class="login-logo">
                MED<span>I</span>VA
            </div>

            <h1>Selamat Datang</h1>

            <p class="login-subtitle">
                Masuk ke akun MEDIVA Anda
            </p>

            @if (session('success'))
                <p class="login-success">
                    {{ session('success') }}
                </p>
            @endif

            @if ($errors->any())
                <div class="login-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                   <input
                   type="password"
                   id="password"
                   name="password"
                   placeholder="masukkan password"
                   autocomplete="current-password"
                   required
                >
                </div>

                <button type="submit" class="primary-button">
                    Login
                </button>
            </form>

            <p class="login-info">
                Akses akan disesuaikan dengan role akun Anda.
            </p>

            <p class="login-register-link">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar di sini</a>
            </p>

        </div>
    </div>
</div>
@endsection