<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\User;
use App\Models\Book;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['user', 'book'])->get();
        return response()->json($reviews);

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
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $review = Review::create($data);

        return response()->json([
            'message' => 'Review created successfully',
            'review' => $review
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with(['user', 'book'])->findOrFail($id);
        return response()->json($review);

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
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $review = Review::findOrFail($id);
        $review->update($data);

        return response()->json([
            'message' => 'Review updated successfully',
            'review' => $review
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
    
}
