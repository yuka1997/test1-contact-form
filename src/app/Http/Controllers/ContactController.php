<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', ['categories' => $categories]);
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'detail', 'category_id']);

        $category = $contact['category_id'] ? Category::find($contact['category_id']) : null;
        return view('confirm', compact('contact', 'category'));
    }

    public function store(ContactRequest $request)
    {
        if ($request->input('action') === 'modify') {
            return redirect('/')
                ->withInput($request->except('action'));
        }

        $tel = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'address', 'building', 'detail', 'category_id']);
        
        $contact['tel'] = $tel;

        Contact::create($contact);
        return redirect('/contacts/thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
