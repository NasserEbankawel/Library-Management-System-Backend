<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);


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
            'gender' => 'required|in:Male,Female,Other',
            'dob' => 'required',
            'biography' => 'required|max:255|min:20'
        ]); //data type is array

        $author = Author::create($data);

        return response()->json([
            'message' => 'Author created successfully',
            'author' => $author
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     
        $author = Author::findOrFail($id);
        return response()->json($author);
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
            'gender' => 'required|in:Male,Female,Other',
            'dob' => 'required',
            'biography' => 'required|max:255|min:20'
        ]);

        $author = Author::findOrFail($id);
        $author->update($data);

        return response()->json([
            'message' => 'Author updated successfully',
            'author' => $author
        ]);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json([
        'message' => 'Author deleted successfully'
        ]);
    }
}
