<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/secound.css') }}" />

    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header-h1">
                Atte
            </h1>
            @if (Auth::check())
            <nav class="header-nav">
                <ul class="haeader__ul">
                    <li class="header__li"><a href="{{ route('rest') }}">ホーム</a></li>

                    <li class=" header__li"><a href="{{ route('attendance.index') }}">日付一覧</a></li>
                    <form class="form" action="/logout" method="post">
                        @csrf
                        <button class="header__li">ログアウト</button>
                    </form>
                </ul>
            </nav>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    <div class="footer">
        Atte,inc
    </div>
</body>

</html>