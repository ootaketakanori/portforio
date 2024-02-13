@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('content')
<div class="container">
    <h2 class="subheader">会員登録</h2>
    <form action="{{ url('/register') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="名前" value="{{ old('username') }}" required>
            <div class="form-error">
                @error('username')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
            <div class="form-error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="パスワード" required>
            <div class="form-error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="confirm_password" placeholder="確認用パスワード" required>

        </div>
        <button class="btn btn-primary" type="submit">会員登録</button>
    </form>
    <p class="login-link">
        アカウントをお持ちの方はこちらから
        <a class="register__button-submit" href="/authenticated">ログイン</a>
    </p>
</div>
@endsection