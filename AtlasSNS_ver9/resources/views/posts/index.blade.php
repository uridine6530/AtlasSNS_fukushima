<x-login-layout>
  {{ Form::open(['url' => 'post']) }}
  {{ Form::input('text', 'post', null, ['required', 'class' => 'post']) }}
  <button type="submit" class="btn"><img src="images/post.png"></button>
  {{ Form::close() }}
  <h2>機能を実装していきましょう。</h2>
  @foreach($posts as $post)
  <img src="images/{{$post->user->icon_image}}" alt="">
  <p>{{$post -> user ->  username}}</p>
  <p>{{$post -> post}}</p>
  <p>{{$post -> updated_at}}</p>
  @if($post-> user_id == Auth::id())
  <form action="{{ route('update', ['id'=>$post->id]) }}" method="POST">
    @csrf
    <input type="text" name="post_content" value="{{$post -> post}}">
    <button type="submit" class="btn">編集</button>
  </form>
  <form action="{{ route('delete', ['id'=>$post->id]) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">削除</button>
  </form>
  @endif
  @endforeach

</x-login-layout>
