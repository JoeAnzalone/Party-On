{{ Form::open(['url' => route('event.store')]) }}
    <label>Title{{ Form::text('title', '', ['placeholder' => 'Title']) }}</label>
    <label>Description{{ Form::textarea('description', '', ['placeholder' => 'Description']) }}</label>
    <label>Location{{ Form::text('location', '', ['placeholder' => 'Location']) }}</label>
    <label>Start Date{{ Form::input('date', 'start_time_date', '', ['placeholder' => 'Location']) }}</label>
    <label>Start Time{{ Form::input('time', 'start_time_time', '', ['placeholder' => 'Location']) }}</label>
    {{ Form::submit(); }}
{{ Form::close() }}
