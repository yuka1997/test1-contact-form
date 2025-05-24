@extends('layouts.app-admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header-button')
<div class="header__button">
  <a href="{{ route('login') }}" class="header__button-item">login</a>
</div>
@endsection


@section('content')
<div class="form-heading">
    <h2 class="form__heading heading">Register</h2>
</div>
<div class="form-content">
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form-group">
            <label class="form-label" for="name">お名前</label>
            <input id="name" type="text" class="form-input" name="name" value="{{ old('name') }}" required autofocus placeholder="例: 山田 太郎">
            @error('name')
                <div class="form__error">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">
            <label class="form-label" for="email">メールアドレス</label>
            <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">パスワード</label>
            <input id="password" type="password" class="form-input" name="password" placeholder="例: coachtech1106">
            @error('password')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-button">
            <button type="submit" class="form-button__submit">登録</button>
        </div>
    </form>
</div>
@endsection
