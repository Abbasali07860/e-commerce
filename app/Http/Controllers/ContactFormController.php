<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'fname' => 'required|string|max:200',
            'lname' => 'required|string|max:200',
            'email' => 'required|email|unique:contacts',
            'message' => 'required|string|min:3|max:1000',
        ]);
        Contact::create($data);
        return redirect()->back()->with('success', 'Form submitted successfully.');
    }
}
