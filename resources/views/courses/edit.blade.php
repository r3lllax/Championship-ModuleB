@php
    use App\Models\Course;
    /** @var Course $course */
@endphp

@extends('layout')
@section('content')
    <div class="card">
        <h2>Создание / редактирование курса</h2>

        <form action="{{route('courses.sendEdit',$course)}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="form-group @error('name') error @enderror">
                <label>Название курса *</label>
                <input type="text" maxlength="30" id="title" name="title" value="{{old('title')?old('title'):$course->title}}">
                @error('title')
                    <div class="error-message">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group @error('description') error @enderror">
                <label>Описание курса</label>
                <textarea id="description" name="description" maxlength="100">{{old('description')?old('description'):$course->description}}</textarea>
            </div>

            <div class="form-group @error('duration') error @enderror">
                <label>Продолжительность (часы) *</label>
                <input id="duration" name="duration" type="number" min="1" max="10" value="{{old('duration')?old('duration'):$course->duration}}">
                @error('duration')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group @error('price') error @enderror">
                <label>Цена *</label>
                <input id="price" name="price" type="text" placeholder="10.00" value="{{old('price')?old('price'):$course->price}}">
                @error('price')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group @error('start_date') error @enderror">
                <label>Дата начала *</label>
                <input id="start_date" name="start_date" type="date" placeholder="дд-мм-гггг" value="{{old('start_date')?old('start_date'):$course->start_date}}">
                @error('start_date')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group @error('end_date') error @enderror">
                <label>Дата окончания *</label>
                <input id="end_date" name="end_date" type="date" placeholder="дд-мм-гггг" value="{{old('end_date')?old('end_date'):$course->end_date}}">
                @error('end_date')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

{{--            <div class="form-group @error('volume') error @enderror">--}}
{{--                <label>Обложка курса (JPG, до 2000 Кб) *</label>--}}
{{--                <input id="volume" name="volume" type="file" accept="image/jpeg" value="{{public_path('volumes')."/".$course->volume}}">--}}
{{--                @error('volume')--}}
{{--                <div class="error-message">--}}
{{--                    {{$message}}--}}
{{--                </div>--}}
{{--                @enderror--}}
{{--            </div>--}}

            <button type="submit">Сохранить курс</button>
        </form>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/course-form.css')}}">
@endpush
