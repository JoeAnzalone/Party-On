{{ Form::model($event, array('route' => array('event.update', $event->id), 'method' => 'put')) }}
    <ul class="fields">
        <li><label for="title">Title</label>{{ Form::text('title', null, ['placeholder' => 'Title', 'id' => 'title']) }}</li>
        <li><label for="description">Description</label>{{ Form::textarea('description', null, ['placeholder' => 'Description', 'id' => 'description']) }}</li>
        <li><label for="location">Location</label>{{ Form::text('location', null, ['placeholder' => 'Location', 'id' => 'location']) }}</li>
        <li><label for="start_time_date">Start Date</label>{{ Form::input('date', 'start_time_date', null, ['placeholder' => 'Location', 'id' => 'start_time_date']) }}</li>
        <li><label for="start_time_time">Start Time</label>{{ Form::input('time', 'start_time_time', null, ['placeholder' => 'Location', 'id' => 'start_time_time']) }}</li>
        <li><label for="guests_string">Guests</label>{{ Form::textarea('guests_string', null, ['placeholder' => 'Guests', 'id' => 'guests_string']) }}</li>
    </ul>
    {{ Form::submit(); }}
{{ Form::close() }}
