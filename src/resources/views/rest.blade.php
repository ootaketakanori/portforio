@extends('layouts.secound')

@section('css')
<link rel="stylesheet" href="{{ asset('css/work_time.css') }}">
@endsection


@section('content')

<div class="content">
    <h2>お疲れ様です。</h2>
    <div class="btn-group">
        <form action="{{ route('startWork') }}" method="get">
            @csrf
            <button type="submit">勤務開始</button>
        </form>

        <form action="{{ route('endWork') }}" method="get">
            @csrf
            <button type="submit">勤務終了</button>
        </form>

        <form action="{{ route('startBreak') }}" method="get">
            @csrf
            <button type="submit">休憩開始</button>
        </form>

        <form action="{{ route('endBreak') }}" method="get">
            @csrf
            <button type="submit">休憩終了</button>
        </form>
    </div>

</div>
@endsection