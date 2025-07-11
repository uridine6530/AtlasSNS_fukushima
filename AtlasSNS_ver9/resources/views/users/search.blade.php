<x-login-layout>
  {{ Form::open(['url' => 'search']) }}
  {{ Form::input('text', 'post', null, ['required', 'class' => 'post']) }}
  <button type="submit" class="btn"><img src="images/search.png"></button>
  {{ Form::close() }}
  {{$keyword}}
  @foreach($users as $user)
  <img src="images/icon1.png" alt="">{{$user -> icon_image}}</img>
  <p class="name">{{$user -> username}}</p>
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
</x-login-layout>
