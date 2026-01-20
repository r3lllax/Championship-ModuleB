@extends('layout')
@section('content')
    <div class="card">
        <h2>Курсы</h2>

        <div class="actions">
            <a href="course-form.html">
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
            <tr>
                <td>Frontend-разработка</td>
                <td>8 ч</td>
                <td>120.00</td>
                <td>01-02-2026 / 10-02-2026</td>
                <td>
                    <a href="course-form.html"><button>Редактировать</button></a>
                    <button class="delete">Удалить</button>
                </td>
            </tr>

            <tr>
                <td>Backend-разработка</td>
                <td>10 ч</td>
                <td>150.00</td>
                <td>05-02-2026 / 20-02-2026</td>
                <td>
                    <a href="course-form.html"><button>Редактировать</button></a>
                    <button class="delete">Удалить</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="pagination">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('/assets/css/courses.css')}}">
@endpush
