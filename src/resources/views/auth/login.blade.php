@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection


@section('content')

<div class="content">
    <h2>ログイン</h2>
    <form action="/login" method="post">
        @csrf
        <div class="form-group">
            <input class="input-email" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
            @error('email')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="input-password" type="password" name="password" placeholder="パスワード" />
            @error('password')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <button class="button-submit" type="submit">ログイン</button>
    </form>
    <p>アカウントを""お持ちでない方はこちらから</p>
    <a class="register__button-submit" href="/register">会員登録</a>
</div>

@endsection