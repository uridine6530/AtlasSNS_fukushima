<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function search(Request $request)
    {
        $keyword = $request->input('post');
        if (!empty($keyword)) {
            $users = User::where('username', 'like', '%' . $keyword . '%')
                ->where('id', '!=', auth()->user()->id)->get();
        } else {
            $users = User::all()->except([\Auth::id()]);
        }
        return view('users.search', compact('keyword', 'users'));
    }
}
