<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profiles.profile', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::user()->id;
        $request->validate([
            'username' => 'required | between:2,12',
            'email' => 'required | between:5,40 | email | unique:users,email,' . Auth::user()->email . ',email',
            'password' => 'required | regex:/^[a-zA-Z0-9]+$/ | min:8 | max:20 | confirmed',
            'bio' => 'nullable |max:150',

        ]);
        User::where('id', $userId)->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'bio' => $request->input('bio'),
        ]);


        if ($request->hasFile('image')) {
            if ($user->icon_image) {
                Storage::delete($user->icon_image);
            }
            $path = $request->file('image')->store('icons', 'public');
            $user->icon_image = $path;
        }

        $user->save();

        return redirect('/profile');
    }
    public function otherProfile($id)
    {
        $users = User::where('id', $id)->get();
        $posts = Post::with('user')->where('user_id', $id)->latest('updated_at')->get();
        return view('profiles.otherProfile', compact('users', 'posts'));
    }
}
