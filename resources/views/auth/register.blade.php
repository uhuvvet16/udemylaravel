@extends('layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}">Anasayfa</a></li>
                    <li class="active">Kayıt Ol</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--register-starts-->
    <div class="register">
        <div class="container">
            <div class="register-top heading">
                <h2>Kayıt Ol</h2>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="register-main">
                    <div class="col-md-6 account-left">
                        <input id="name" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                            placeholder="Ad Soyad" type="text" tabindex="1" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="email" class="@error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" placeholder="Mail Adresiniz" type="text" tabindex="3" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 account-left">
                        <input id="password" class="@error('password') is-invalid @enderror" name="password"
                            placeholder="Şifreniz" type="password" tabindex="4" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Şifreniz Tekrar"
                            required autocomplete="new-password">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="address submit">
                    <input type="submit" value="Gönder">
                </div>
            </form>
        </div>
    </div>

@endsection
