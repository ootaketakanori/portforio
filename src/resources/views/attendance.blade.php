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
                <td>勤務開始:{{ $entry->start_time }}</td>
                <td>勤務終了:{{ $entry->end_time }}</td>
                <td>休憩時間:{{ $entry->break_duration }}</td>
                <td>勤務時間:{{ $entry->work_duration }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $entries->withPath('/attendance')->links() }}

@endsection

@php
// この関数は秒数をHH:MM:SS形式に変換します。
function formatDuration($seconds) {
$hours = floor($seconds / 3600);
$minutes = floor(($seconds % 3600) / 60);
$seconds = $seconds % 60;
return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}
@endphp