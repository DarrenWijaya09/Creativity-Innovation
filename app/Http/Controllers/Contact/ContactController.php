<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'category' => [
                'required',
                'max:100',
            ],

            'message' => [
                'required',
                'min:20',
                'max:5000',
            ],

        ]);

        ContactMessage::create([

            'user_id' => Auth::id(),

            'name' => $validated['name'],

            'email' => $validated['email'],

            'category' => $validated['category'],

            'message' => $validated['message'],

            'status' => 'pending',

        ]);

        return back()->with(
            'success',
            'Pesan berhasil dikirim. Tim kami akan menghubungi Anda dalam 1x24 jam.'
        );
    }
}
