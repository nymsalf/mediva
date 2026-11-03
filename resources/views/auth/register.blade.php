@extends('layouts.app')

@section('content')
<div class="register-page">
    <div class="register-card">
        <a href="/" class="register-logo">
            MED<span>I</span>VA
        </a>

        <p class="register-label">REGISTRASI PASIEN</p>
        <h1>Buat Akun</h1>
        <p class="register-description">
            Daftar untuk mulai menggunakan layanan MEDIVA.
        </p>

        @if ($errors->any())
            <div class="register-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="register-field">
                <label for="name">Nama lengkap</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    required
                >
            </div>

            <div class="register-field">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="register-field">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="register-field">
                <label for="password_confirmation">
                    Konfirmasi password
                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="register-button">
                Buat Akun
            </button>
        </form>

        <p class="register-login-link">
            Sudah punya akun?
            <a href="/login">Login di sini</a>
        </p>
    </div>
</div>
@endsection
