@extends('layouts.app-admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header-button')
<div class="header__button">
  <a href="{{ route('register') }}" class="header__button-item">register</a>
</div>
@endsection


@section('content')
<div class="form-heading">
    <h2 class="form__heading heading">Login</h2>
</div>
<div class="form-content">
  <form class="form" action="/login" method="post">
    @csrf

    <div class="form-group">
      <label class="form-label">
        <span class="form-label__text">メールアドレス</span>
      </label>
      <div class="form-input">
        <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com"/>
      </div>
        @error('email')
          <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
      <label class="form-label">
        <span class="form-label__text">パスワード</span>
      </label>
      <div class="form-input">
        <input type="password" name="password" placeholder="例: coachtech1106"/>
      </div>
        @error('password')
          <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button">
      <button class="form-button__submit" type="submit">ログイン</button>
    </div>
  </form>
</div>
@endsection
