{{ Form::open(['url' => route('user.do_login')]) }}
    <label>Email{{ Form::email('email', '', ['placeholder' => 'Email address']) }}</label>
    <label>Password{{ Form::password('password', '', ['placeholder' => 'Email address']) }}</label>
    {{ Form::submit(); }}
{{ Form::close() }}
