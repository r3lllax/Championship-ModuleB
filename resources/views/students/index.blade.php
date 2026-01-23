@php use App\Models\Course;use App\Models\Record;use App\Models\User;use Carbon\Carbon; @endphp
@php
    /** @var Record[] $records */
    /** @var Record $record */
    /** @var Course[] $courses*/
    /** @var Course $course */
    $courses = Course::all();
@endphp
@extends('layout')
@section('content')
    <div class="card">
        <h2>Студенты</h2>
        <label>Фильтр по курсу:</label>
        <select
            onchange="window.location.href = 'http://localhost:8000/course-admin/students'+ (this.value?('?course=' + this.value):'')">
            <option value="{{null}}">Все курсы</option>
            @foreach($courses as $course)
                <option
                    {{request('course')==$course->id?'selected':''}} value="{{$course->id}}">{{$course->title}}</option>
            @endforeach
        </select>

        <table>
            <thead>
            <tr>
                <th>Email</th>
                {{--                <th>Имя</th>--}}
                <th>Курс</th>
                <th>Дата записи</th>
                <th>Статус оплаты</th>
                <th>Сертификат</th>
            </tr>
            </thead>
            <tbody>
            @foreach($records as $record)
                @php
                    /** @var User $student */
                    $student = $record->user;
                @endphp
                <tr>
                    <td>{{$student->email}}</td>
                    {{--                    <td>Иван Иванов</td>--}}
                    <td>{{$record->course->title}}</td>
                    <td>{{$record->date}}</td>
                    <td class="status
                        @if($record->payment_status == "success") paid @endif
                        @if($record->payment_status == "pending") pending @endif
                        @if($record->payment_status == "failed") error @endif
                        ">{{$record->payment_status}}</td>
                    <td>
                        <a href="{{route('students.certificate',[
    'course'=>$record->course,
    'student'=>$record->user
])}}">
                            <button
                                @if(Carbon::now()->isBefore(Carbon::parse($record->course->end_date))) disabled @endif
                            class="print @if(Carbon::now()->isBefore(Carbon::parse($record->course->end_date))) disabled @endif
                            @if($record->payment_status=="pending" || $record->payment_status=="failed") disabled @endif
                        ">Печать</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$records->links()}}
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/students.css')}}">
@endpush
