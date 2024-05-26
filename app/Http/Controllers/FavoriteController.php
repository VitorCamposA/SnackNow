<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FavoriteController extends Controller
{
    public function addFavorite($id)
    {
        $user = Auth::user();
        $favoriteUser = User::findOrFail($id);

        if (!$user->favorites?->contains($favoriteUser->id)) {
            $user->favorites()->attach($favoriteUser->id);
        }

        return redirect()->back()->with('success', 'Usuário adicionado aos favoritos!');
    }

    public function removeFavorite($id)
    {
        $user = Auth::user();
        $favoriteUser = User::findOrFail($id);

        if ($user->favorites?->contains($favoriteUser->id)) {
            $user->favorites()->detach($favoriteUser->id);
        }

        return redirect()->back()->with('success', 'Usuário removido dos favoritos!');
    }
}
