{{ Form::open(['url' => route('user.do_login')]) }}
    <label for="email">Email</label>{{ Form::email('email', null, ['placeholder' => 'Email address', 'id' => 'email', 'autofocus']) }}
    <label for="password">Password</label>{{ Form::password('password', ['id' => 'password']) }}
    {{ Form::submit(); }}
{{ Form::close() }}
