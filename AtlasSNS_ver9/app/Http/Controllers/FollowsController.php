<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        $auth_user = Auth::user();
        $followings = $auth_user->following_user;
        $followings_id = $auth_user->following_user()->pluck('followed_id');
        $posts = Post::with('user')->whereIn('user_id', $followings_id)->latest('updated_at')->get();
        return view('follows.followList', compact('followings', 'posts'));
    }
    public function followerList()
    {
        $auth_user = Auth::user();
        $followed_users = $auth_user->followed_user;
        $followed_id = $auth_user->followed_user()->pluck('following_id');
        $posts = Post::with('user')->whereIn('user_id', $followed_id)->latest('updated_at')->get();
        return view('follows.followerList', compact('followed_users', 'posts'));
    }

    public function follow($id)
    {
        $following_id = Auth::user();
        $is_following = $following_id->is_following($id);
        if (!$is_following) {
            $following_id->follow($id);
            return back();
        }
    }

    public function unfollow($id)
    {
        $following_id = Auth::user();
        $is_following = $following_id->is_following($id);
        if ($is_following) {
            $following_id->unfollow($id);
            return back();
        }
    }
}
