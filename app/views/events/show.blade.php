<h1>{{ $event['title'] }}</h1>

<div class="description">{{ $event['description'] }}</div>

<h2>Location</h2>
<div class="location">{{ $event['location'] }}</div>

<h2>Start Time</h2>
<div class="start_time">{{ $event['start_time'] }}</div>

<h2>End Time</h2>
<div class="end_time">{{ $event['end_time'] }}</div>

@if (!empty($key))
    <h2>Your current response: <strong>{{ $response }}</strong></h2>
    Change it here:
    {{ HTML::linkAction('GuestsController@editResponse', 'Yes', [$key, 'yes']) }} /
    {{ HTML::linkAction('GuestsController@editResponse', 'No', [$key, 'no']) }} /
    {{ HTML::linkAction('GuestsController@editResponse', 'Maybe', [$key, 'maybe']) }}
@endif
