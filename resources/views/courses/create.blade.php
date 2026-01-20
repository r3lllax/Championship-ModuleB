@extends('layout')
@section('content')
    <div class="card">
        <h2>Создание / редактирование курса</h2>

        <form method="post" enctype="multipart/form-data">

            <div class="form-group error">
                <label>Название курса *</label>
                <input type="text" maxlength="30">
                <div class="error-message">
                    Название обязательно, не более 30 символов
                </div>
            </div>

            <div class="form-group">
                <label>Описание курса</label>
                <textarea maxlength="100"></textarea>
            </div>

            <div class="form-group error">
                <label>Продолжительность (часы) *</label>
                <input type="number" max="10">
                <div class="error-message">
                    Целое число, не более 10
                </div>
            </div>

            <div class="form-group error">
                <label>Цена *</label>
                <input type="text" placeholder="100.00">
                <div class="error-message">
                    Формат xx.xx, минимум 100
                </div>
            </div>

            <div class="form-group error">
                <label>Дата начала *</label>
                <input type="text" placeholder="дд-мм-гггг">
                <div class="error-message">
                    Неверный формат даты
                </div>
            </div>

            <div class="form-group error">
                <label>Дата окончания *</label>
                <input type="text" placeholder="дд-мм-гггг">
                <div class="error-message">
                    Неверный формат даты
                </div>
            </div>

            <div class="form-group error">
                <label>Обложка курса (JPG, до 2000 Кб) *</label>
                <input type="file" accept="image/jpeg">
                <div class="error-message">
                    Требуется JPG/JPEG изображение
                </div>
            </div>

            <button type="submit">Сохранить курс</button>
        </form>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/course-form.css')}}">
@endpush
