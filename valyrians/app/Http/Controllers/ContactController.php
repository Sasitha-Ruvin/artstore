<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function showForm()
    {
        return view('contact.form');
    }
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Send data to Firebase
        $firebaseUrl = 'https://valyrian-visions-c7129.asia-southeast1.firebasedatabase.app/contactMessages.json';
        Http::post($firebaseUrl, [
            'name' => $request->name,
            'email' => $request->category,
            'message' => $request->description,
        ]);

        return redirect()->route('contact.form')->with('success', 'Your commission request has been submitted successfully!');
    }
}
