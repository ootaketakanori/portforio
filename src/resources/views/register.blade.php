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
            <input type="text" class="form-control" id="name" name="name" placeholder="名前" required>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス" required>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="パスワード" required>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="確認用パスワード" required>
        </div>
        <input type="submit" class="btn btn-primary" value="会員登録">
    </form>
    <p class="login-link">
        アカウントをお持ちの方はこちらから
        <a href="/authenticated">ログイン</a>
    </p>
</div>
@endsection