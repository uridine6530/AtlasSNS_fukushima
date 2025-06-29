<x-login-layout>
  <h2>フォロワーリスト</h2>

  @foreach($followed_users as $followed_user)
  <a href="{{ route('other', ['id' => $followed_user->id ])}}">
    <img src="{{asset('images/' . $followed_user->icon_image)}}" alt="">
  </a>
  @endforeach

  <ul>
    @foreach($posts as $post)
    <li>
      <img src="{{asset('images/' . $post->user->icon_image)}}" alt="">
      <p>{{$post->user->username}}</p>
      <p>{{$post->post}}</p>
      <p>{{$post->updated_at}}</p>
    </li>
    @endforeach
  </ul>
</x-login-layout>
