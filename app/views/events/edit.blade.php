{{ Form::model($event, array('route' => array('event.update', $event->id), 'method' => 'put')) }}
    <label>Title{{ Form::text('title', null, ['placeholder' => 'Title']) }}</label>
    <label>Description{{ Form::textarea('description', null, ['placeholder' => 'Description']) }}</label>
    <label>Location{{ Form::text('location', null, ['placeholder' => 'Location']) }}</label>
    <label>Start Date{{ Form::input('date', 'start_time_date', null, ['placeholder' => 'Location']) }}</label>
    <label>Start Time{{ Form::input('time', 'start_time_time', null, ['placeholder' => 'Location']) }}</label>
    <label>Guests{{ Form::textarea('guests_string', null, ['placeholder' => 'Guests']) }}</label>

    {{ Form::submit(); }}
{{ Form::close() }}
