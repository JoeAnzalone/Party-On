{{ Form::model($event, array('route' => array('event.update', $event->id), 'method' => 'put')) }}
    <ul class="fields">
        <li><label for="title">Title</label>{{ Form::text('title', null, ['placeholder' => 'Title', 'id' => 'title']) }}</li>
        <li><label for="description">Description</label>{{ Form::textarea('description', null, ['placeholder' => 'Description', 'id' => 'description']) }}</li>
        <li><label for="location_name">Location Name</label>{{ Form::text('location_name', null, ['placeholder' => 'Location name', 'id' => 'location_name']) }}</li>
        <li><label for="location_address">Location Address</label>{{ Form::text('location_address', null, ['placeholder' => 'Location address', 'id' => 'location_address']) }}</li>
        <li><label for="start_time_date">Start Date</label>{{ Form::input('date', 'start_time_date', null, ['placeholder' => 'Location', 'id' => 'start_time_date']) }}</li>
        <li><label for="start_time_time">Start Time</label>{{ Form::input('time', 'start_time_time', null, ['placeholder' => 'Location', 'id' => 'start_time_time']) }}</li>
        <li><label for="guests_string">Guests</label>{{ Form::textarea('guests_string', null, ['placeholder' => 'Guests', 'id' => 'guests_string']) }}</li>
    </ul>
    {{ Form::submit(); }}
{{ Form::close() }}
