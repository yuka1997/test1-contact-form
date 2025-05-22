@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2 class="confirm__heading heading">Confirm</h2>
    </div>
    <form class="form" action="/contacts" method="post">
    @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <div class="name-input">
                            <div class="form__input--text">
                                <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                            </div>
                            <div class="form__input--text">
                                <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        @php
                        $gender_labels = [
                            1 => '男性',
                            2 => '女性',
                            3 => 'その他',
                        ];

                        @endphp
                        {{ $gender_labels[$contact['gender']] ?? '' }}
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">

                        <div class="form__group--content">
                            <div class="form__input--tel-group">
                                <input type="text" value="{{ ($contact['tel1'] ?? '') . ($contact['tel2'] ?? '') . ($contact['tel3'] ?? '') }}" class="form__input--tel" readonly>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{ $category->content ?? '' }}
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit" name="action" value="submit">送信</button>
            <button class="form__button-modify" type="submit" formaction="/contacts" name="action" value="modify">修正</button>
        </div>
    </form>
</div>