@extends('layouts.secound')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendancce.css') }}">
@endsection


@section('content')


<div class="main__inner">
    <div class="page">
        <form action="{{ route('previousPage') }}" method="get">
            @csrf
            <button type="submit">
                < </button>
        </form>
        <p class="date">{{ Carbon\Carbon::today()->format('Y/m/d') }}</p>
        <form action="{{ route('nextPage') }}" method="get">
            @csrf
            <button type="submit">></button>
        </form>
    </div>
    <table class="main-table">
        <thead>
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
            <tr>
                <td>名前: {{ $entry->user->name }}</td>
                <td>勤務開始:{{ $startWorkTime }}</td>
                <td>勤務終了:{{ $entry['endWork']  }}</td>
                <td>休憩時間:{{ $entry['breakTime'] }}</td>
                <td>勤務時間:{{ $entry[''] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
{{ $entries->links() }}