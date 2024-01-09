@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('css/authen.css') }}">
@endsection


@section('content')

<div class="content">
    <h2>ログイン</h2>
    <form action="/login" method="post">
        <input type="email" name="email" placeholder="メールアドレス">
        <input type="password" name=password"email" placeholder="パスワード">
        <input type="submit" value="ログイン">
    </form>
    <p>アカウントをお持ちでない方はこちらから</p>
    <a href="/signup">会員登録</a>
</div>

@endsection