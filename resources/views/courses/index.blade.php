@php
    /** @var \App\Models\Course[] $courses */
@endphp
@extends('layout')
@section('content')
    <div class="card">
        <h2>Курсы</h2>

        <div class="actions">
            <a href="{{route('courses.create')}}">
                <button>Создать курс</button>
            </a>
        </div>

        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th>Продолжительность</th>
                <th>Цена</th>
                <th>Даты</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>

            @foreach($courses as $course)
                @php
                /** @var \App\Models\Course $course */
                @endphp
                <tr>
                    <td>{{$course->title}}</td>
                    <td>{{$course->duration}} ч</td>
                    <td>{{$course->price}}.00</td>
                    <td>{{$course->start_date}} / {{$course->end_date}}</td>
                    <td>
                        <a href="{{route('courses.edit',$course)}}"><button>Редактировать</button></a>
                        <a href="{{route('courses.delete',$course)}}" ><button class="delete">Удалить</button></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

{{--        <div class="pagination">--}}
{{--            <a href="#">1</a>--}}
{{--            <a href="#">2</a>--}}
{{--            <a href="#">3</a>--}}
            {{$courses->links()}}
{{--        </div>--}}
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/courses.css')}}">
@endpush
