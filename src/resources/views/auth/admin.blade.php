@extends('layouts.app-admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-button')
<form class="form" action="/logout" method="post">
  @csrf
  <button type="submit" class="header__button-item">logout</button>
</form>
@endsection

@section('content')
<div class="admin-content">
  <h2 class="form__heading heading">Admin</h2>

  <div class="form-content">
    <form class="form" method="GET" action="{{ route('admin.index') }}">
      <div class="form-group">
        <input type="text" name="keyword" class="form-input" placeholder="名前やメールアドレスを入力してください">
      </div>
      <div class="form-group">
      <select name="gender" class="form-input">
        <option value="">性別</option>
        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
      </select>
      </div>
      <div class="form-group">
        <select name="category" class="form-input">
          <option value="">お問い合わせの種類</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
              {{ $category->content }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <input type="date" name="date" class="form-input" value="{{ request('date') }}">
      </div>
      <div class="form-group form-button-group">
        <button type="submit" class="form-button__submit--find">検索</button>
        <button type="button" onclick="location.href='{{ route('admin.index') }}'" class="form-button__submit--reset">リセット</button>
      </div>
    </form>
  </div>

  <div class="pagination-export-wrapper">
    <div class="form-button">
      <button class="form-button__submit--export">エクスポート</button>
    </div>
    <div class="admin-pagination">
      {{ $contacts->links('vendor.pagination.default') }}
    </div>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($contacts as $contact)
      <tr>
        <td>{{ $contact->full_name }}</td> 
        <td>{{ $contact->gender_label }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ optional($contact->category)->content }}</td>
        <td><button class="form-button__submit--detail" onclick="openModal({{ $contact->id }})">詳細</button></td>
      </tr>
      <tr class="modal-wrapper" style="display:none;" id="modal-{{ $contact->id }}">
        <td colspan="5">
          <div class="modal-content">
            <button class="modal-close" onclick="closeModal({{ $contact->id }})">×</button>
            <table class="modal-table">
              <tr><th>お名前</th><td>{{ $contact->full_name }}</td></tr>
              <tr><th>性別</th><td>{{ $contact->gender_label }}</td></tr>
              <tr><th>メールアドレス</th><td>{{ $contact->email }}</td></tr>
              <tr><th>電話番号</th><td>{{ $contact->tel }}</td></tr>
              <tr><th>住所</th><td>{{ preg_replace('/^\d{3}-\d{4}\s*/', '', $contact->address) }}</td></tr>
              <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
              <tr><th>お問い合わせの種類</th><td>{{ optional($contact->category)->content }}</td></tr>
              <tr><th>お問い合わせ内容</th><td>{{ $contact->content }}</td></tr>
            </table>
            <form action="{{ route('admin.destroy', $contact->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="form-button__submit--delete">削除</button>
            </form>
          </div>
        </td>
      </tr>

      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script>
  function openModal(id) {
    document.getElementById('modal-' + id).style.display = 'table-row';
  }

  function closeModal(id) {
    document.getElementById('modal-' + id).style.display = 'none';
  }
</script>
@endsection
