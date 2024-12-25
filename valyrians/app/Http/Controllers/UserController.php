<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Resources\UserResource;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password' => 'required| string|min:8'
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>bcrypt($request->password),
        ]);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email' .$user->id,
            'password'=> 'sometimes|required|string|min:8',
        ]);

        $user->update($request->only(['name','email','password']));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $user =User::findOrFail($id);
        $user->delete();

        return response()->json(null,204);
    }

}
