@php use App\Models\Course;use App\Models\Lesson; @endphp
@php
    /** @var Lesson[] $lessons */
@endphp
@extends('layout')
@section('content')
    <div class="card">
        <h2>Уроки курса</h2>

        <a href="{{route('lessons.create',$course)}}">
            <button>Добавить урок</button>
        </a>

        @if($lessons->count())
            <table>
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Длительность (ч)</th>
                    <th>Видео SuperTube</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessons as $lesson)
                    @php /** @var Lesson $lesson */ @endphp
                    <tr>
                        <td>{{$lesson->title}}</td>
                        <td>{{$lesson->duration}}</td>
                        <td><a href="{{$lesson->video_link}}">Ссылка</a></td>
                        <td class="buttons">
                            <a href="{{route('lessons.edit',$lesson)}}">
                                <button>Редактировать</button>
                            </a>
                            @if($lesson->course->users->count()==0)
                                <a href="{{route('lessons.delete',$lesson)}}">
                                    <button class="delete ">Удалить</button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        @if(!$lessons->count())
            <span>У данного курса нет уроков.</span>
        @endif
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/lessons.css')}}">
@endpush
