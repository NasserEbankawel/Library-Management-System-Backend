<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
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
            'title' => 'required|string|min:4|max:50',
            'description' => 'required|min:10|max:200',
            'year' => 'date',
            'pages' => 'required|integer|min:1|max:10000',
            'language' => 'required|string|min:4|max:255',
            'available_copies' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);
    
        $book = Book::create($data);
    
        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
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
    {   $data = $request->validate([
            'title' => 'required|string|min:4|max:50',
            'description' => 'required|min:10|max:200',
            'year' => 'date',
            'pages' => 'required|integer|min:1|max:10000',
            'language' => 'required|string|min:4|max:255',
            'available_copies' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'

        ]);

        $book = Book::findOrFail($id);
        $book->update($data);

        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
        'message' => 'Book deleted successfully'
        ]);
    }
}
