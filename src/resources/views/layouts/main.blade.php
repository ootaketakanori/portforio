<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div clss="header-titile">
                <h1 class="header-h1">
                    Atte
                </h1>
            </div>
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