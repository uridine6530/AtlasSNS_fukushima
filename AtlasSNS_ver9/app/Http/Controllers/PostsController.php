<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class PostsController extends Controller
{
    //
    public function index()
    {
        $posts = Post::with('user')->get();
        // dd($posts);
        return view('posts.index', compact('posts'));
    }

    public function post_create(Request $request)
    {
        $post = $request->input('post');
        $user = auth()->user()->id;
        Post::create([
            'post' => $post,
            'user_id' => $user,

        ]);
        return redirect('top');
    }

    public function update(Request $request, $id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $post = Post::find($id);
        $post_content = $request->input('post_content');
        // レコードを削除
        Post::where('id', $id)->update([
            'post' => $post_content
        ]);
        // 削除したら一覧画面にリダイレクト
        return redirect('/top');
    }

    public function delete($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $post = Post::find($id);
        // レコードを削除
        $post->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect('/top');
    }
}
