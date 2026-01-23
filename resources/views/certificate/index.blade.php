@php use App\Models\Course;use App\Models\User; @endphp
@php
    /** @var User $student */
    /** @var Course $course */
    /** @var string $certificate */
@endphp
@extends('layout')
@section('content')
    <div class="certificate">
        <h1>Сертификат</h1>
        <div class="student-name">{{$student->email}}</div>
        <div class="course-name">{{$course->title}}</div>
        <div>успешно завершил курс</div>

        <div class="date">Дата: {{$course->end_date}}</div>
        <div class="number">№: {{$certificate}}</div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/certificate.css')}}">
@endpush
