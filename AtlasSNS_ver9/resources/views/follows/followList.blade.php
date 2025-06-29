<x-login-layout>
  <h2>フォロー🐿️</h2>
  @foreach($followings as $following)
  <a href="{{ route('other', ['id' => $following->id ])}}">
    <img src="{{asset('images/' . $following->icon_image)}}" alt="">
  </a>
  @endforeach

  @foreach($posts as $post)
  <ul>
    <li>
      <img src="{{asset('images/' . $post->user->icon_image)}}" alt="">
      <p>{{$post->user->username}}</p>
      <p>{{$post->post}}</p>
      <p>{{$post->updated_at}}</p>
    </li>
    @endforeach
  </ul>
</x-login-layout>
