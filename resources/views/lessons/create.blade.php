@php use App\Models\Course; @endphp
@php
    /** @var Course $course */
@endphp

@extends('layout')
@section('content')
    <div class="card">
        <h2>Создание</h2>

        <form action="" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="form-group @error('title') error @enderror">
                <label>Название урока *</label>
                <input type="text" maxlength="30" id="title" name="title"
                       value="">
                @error('title')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group @error('content') error @enderror">
                <label>Описание урока *</label>
                <textarea id="content" name="content" maxlength="100"></textarea>
                @error('content')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group @error('video_link') error @enderror">
                <label>Ссылка</label>
                <input id="video_link" name="video_link" type="text" value="">
                @error('video_link')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group @error('duration') error @enderror">
                <label>Продолжительность (часы) *</label>
                <input id="duration" name="duration" type="number" min="1" max="10"
                       value="">
                @error('duration')
                <div class="error-message">
                    {{$message}}
                </div>
                @enderror
            </div>

            <button type="submit">Сохранить урок</button>
        </form>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/course-form.css')}}">
@endpush
