@extends('layout')
@section('content')
<div class="login-wrapper">
    <h1>Вход в админ-панель</h1>

    <form action="{{route('login.send')}}" method="post" novalidate>
        @csrf
        <div class="form-group @error('email') error @enderror">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="admin@mail.com">
            @error('email')
            <div class="error-message">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group @error('password') error @enderror">
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password">
            @error('password')
            <div class="error-message">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit">Войти</button>
    </form>
</div>
@endsection
