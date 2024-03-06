@extends('layouts.secound')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rest.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
@endsection


@section('content')

<div class="content">
    <h2>お疲れ様です。</h2>
    <div class="btn-group">
        <form action="{{ route('startWork') }}" class="startwork" method="post">
            @csrf
            <button class="btn-startwork" type="submit">勤務開始</button>
        </form>

        <form action="{{ route('endWork') }}" class="endwork" method="post">
            @csrf
            <button class="btn-endwork" type="submit">勤務終了</button>
        </form>

        <form action="{{ route('startBreak') }}" class="break-start" method="post">
            @csrf
            <button class="btn-break-start" type="submit">休憩開始</button>
        </form>
        <form action="{{ route('endBreak') }}" class="break-end" method="post">
            @csrf
            <button class="btn-break-end" type="submit">休憩終了</button>
        </form>
    </div>

</div>
@endsection