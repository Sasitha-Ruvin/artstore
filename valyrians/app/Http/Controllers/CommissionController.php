<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CommissionController;

class CommissionController extends Controller
{
    public function showForm()
    {
        return view('commission.form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Send data to Firebase
        $firebaseUrl = 'https://valyrian-visions-c7129.asia-southeast1.firebasedatabase.app/'; 
        Http::post($firebaseUrl, [
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('commission.form')->with('success', 'Your commission request has been submitted successfully!');
    }
}
