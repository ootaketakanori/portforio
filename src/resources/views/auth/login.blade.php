@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authen.css') }}">
@endsection


@section('content')

<div class="content">
    <h2>ログイン</h2>
    <form action="/login" method="post">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
        </div>
        <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
        </div>
        <input type="password" name="password" placeholder="パスワード">
        <button class="button-submit" type="submit">ログイン</button>
    </form>
    <p>アカウントを""お持ちでない方はこちらから</p>
    <a class="register__button-submit" href="/register">会員登録</a>
</div>

@endsection