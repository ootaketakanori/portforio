@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('content')
<div class="container">
    <h2 class="subheader">会員登録</h2>
    <form action="/register" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{ old('name') }}" required>
            <div class="form-error">
                @errror('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス" value="{{ old('name') }}" required>
            <div class="form-error">
                @errror('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="パスワード" value="{{ old('name') }}" required>
            <div class="form-error">
                @errror('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="確認用パスワード" required>

        </div>
        <button class="btn btn-primary" type="submit">会員登録</button>
    </form>
    <p class="login-link">
        アカウントをお持ちの方はこちらから
        <a class="register__button-submit" href="/authenticated">ログイン</a>
    </p>
</div>
@endsection