<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $restaurant)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $restaurant = User::where('id', $restaurant)->firstOrFail();

        $restaurant->comments()->create($request->only('author', 'content'));

        return redirect()->route('show', encrypt($restaurant->id));
    }
}

