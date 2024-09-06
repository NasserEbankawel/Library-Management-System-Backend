<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|string|min:4|max:50',
            'email' => 'required|unique:users|min:4|max:30',
            'password' => 'required|min:4|max:255|confirmed',
            'role' => 'required|in:admin,member'
        ]);
    
        $user = User::create($data);
    
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);

  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'fullname' => 'required|string|min:4|max:50',
            'email' => 'required|min:4|max:30',
            'password' => 'required|min:4|max:255|confirmed',
            'role' => 'required|in:admin,member'
        ]); 

        $user = User::findOrFail($id);
        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
        'message' => 'User deleted successfully'
        ]);
    }
}

