<x-login-layout>
  @foreach($users as $user)
  <img src="{{asset('images/' . $user->icon_image)}}" alt="">
  <p>ユーザー名</p>
  <p>{{$user -> username}}</p>
  <p>自己紹介</p>
  <p>{{$user -> bio}}</p>
  @if(!auth()->user()->is_following($user->id))
  <form method="post" action="{{route('follow',['id'=>$user->id] )}}">
    @csrf
    <button type='submit' class="" value="submit">フォローする</button>
  </form>
  @else
  <form method="post" action="{{route('unfollow',['id'=>$user->id] )}}">
    @csrf
    <button type='submit' class="" value="submit">フォロー解除する</button>
  </form>
  @endif
  @endforeach

  @foreach($posts as $post)
  <img src="{{asset('images/' . $post->user->icon_image)}}" alt="">
  <p>{{ $post->user->username}}</p>
  <p>{{ $post->post}}</p>
  <p>{{ $post->updated_at}}</p>
  @endforeach
</x-login-layout>
