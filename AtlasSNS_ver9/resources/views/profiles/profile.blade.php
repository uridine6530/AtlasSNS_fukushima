<x-login-layout>

  @if($errors->any())
  @foreach($errors->all() as $error)
  <p>{{$error}}</p>
  @endforeach
  @endif

  {{ Form::open(['url' => 'profile-update', 'files' => true]) }}

  {{ Form::label ('ユーザー名')}}
  {{ Form::input('text', 'username', $user->username, ['required', 'class' => 'post']) }}

  {{ Form::label ('メールアドレス')}}
  {{ Form::input('mail', 'email', $user->email, ['required', 'class' => 'post']) }}

  {{ Form::label ('パスワード')}}
  {{ Form::input('password', 'password', null, ['required', 'class' => 'post']) }}

  {{ Form::label ('パスワード確認')}}
  {{ Form::input('password', 'password_confirmation', null, ['required', 'class' => 'post']) }}

  {{ Form::label ('自己紹介')}}
  {{ Form::input('text', 'bio', $user->bio, ['class' => 'post']) }}

  {{ Form::label ('アイコン画像')}}
  {{ Form::file('image', ['class' => 'post']) }}

  <button type="submit" class="btn">更新</button>
  {{ Form::close() }}
</x-login-layout>
