<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name'     => 'required|string|max:255',
            'first_name'    => 'required|string|max:255',
            'gender'        => 'required|in:1,2,3',
            'email'         => 'required|email|max:255',
            'tel1'          => ['required', 'digits_between:1,5', 'numeric'],
            'tel2'          => ['required', 'digits_between:1,5', 'numeric'],
            'tel3'          => ['required', 'digits_between:1,5', 'numeric'],
            'address'       => 'required|string|max:255',
            'building'      => 'nullable|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'detail'        => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'      => '姓を入力してください',
            'first_name.required'     => '名を入力してください',
            'gender.required'         => '性別を選択してください',

            'email.required'          => 'メールアドレスを入力してください',
            'email.email'             => 'メールアドレスはメール形式で入力してください',

            'tel1.required'           => '電話番号を入力してください',
            'tel1.numeric'            => '電話番号は半角数字で入力してください',
            'tel1.digits_between'     => '電話番号は1〜5桁で入力してください',

            'tel2.required'           => '電話番号を入力してください',
            'tel2.numeric'            => '電話番号は半角数字で入力してください',
            'tel2.digits_between'     => '電話番号は1〜5桁で入力してください',

            'tel3.required'           => '電話番号を入力してください',
            'tel3.numeric'            => '電話番号は半角数字で入力してください',
            'tel3.digits_between'     => '電話番号は1〜5桁で入力してください',

            'address.required'        => '住所を入力してください',

            'building.string'        => '建物名は文字列で入力してください',

            'category_id.required'    => 'お問い合わせの種類を選択してください',
            'category_id.exists'      => 'お問い合わせの種類が正しくありません',

            'detail.required'         => 'お問い合わせ内容を入力してください',
            'detail.max'              => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
