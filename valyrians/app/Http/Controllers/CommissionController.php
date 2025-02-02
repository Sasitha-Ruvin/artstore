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
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'contact'     => 'required|string|max:255',
            'product'     => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        

        // Send data to Firebase
        $firebaseUrl = 'https://valyrian-visions-c7129.asia-southeast1.firebasedatabase.app/commissions.json'; 
        $response = Http::post($firebaseUrl, [
            'name'        => $request->name,
            'email'       => $request->email,
            'contact'     => $request->contact,
            'product'     => $request->product,
            'description' => $request->description,
            'status'      => 'pending'

        ]);


        return redirect()->route('commission.form')->with('success', 'Your commission request has been submitted successfully!');
    }
    public function index()
    {
        $firebaseUrl = 'https://valyrian-visions-c7129.asia-southeast1.firebasedatabase.app/commissions.json';
        $response = Http::get($firebaseUrl);
        $commissions = $response->json();

        // If no commissions are returned, ensure we have an empty array
        if (!$commissions) {
            $commissions = [];
        }

        return view('commission.index', compact('commissions'));
    }
    public function accept($id)
    {
        // Build URL for the specific commission (with .json extension)
        $firebaseUrl = 'https://valyrian-visions-c7129.asia-southeast1.firebasedatabase.app/commissions/' . $id . '.json';

        // Update the commission status to accepted
        $response = Http::patch($firebaseUrl, ['status' => 'accepted']);

        if ($response->successful()) {
            return redirect()->route('commissions.index')->with('success', 'Commission accepted successfully!');
        } else {
            \Log::error('Error accepting commission: ' . $response->body());
            return redirect()->route('commissions.index')->with('error', 'Failed to accept commission.');
        }
    }
}
