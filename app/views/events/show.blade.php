<h1>{{ $event['title'] }}</h1>

<div class="description">{{ $event['description'] }}</div>

<h2>Location</h2>
<div class="location">{{ $event['location'] }}</div>

<h2>Start Time</h2>
<div class="start_time">{{ $event['start_time'] }}</div>

<h2>End Time</h2>
<div class="end_time">{{ $event['end_time'] }}</div>

@if (!empty($guest['key']))
    <h2>Your current response: <strong>{{ $guest['response'] }}</strong></h2>
    Change it here:
    {{ HTML::linkAction('GuestsController@editResponse', 'Yes', [$guest['key'], 'yes']) }} /
    {{ HTML::linkAction('GuestsController@editResponse', 'No', [$guest['key'], 'no']) }} /
    {{ HTML::linkAction('GuestsController@editResponse', 'Maybe', [$guest['key'], 'maybe']) }}
@endif

@if (!empty($event->guests))
    <h2>Guests</h2>
    <ul class="guests">
        @foreach ($event['guests'] as $guest)
            <li>
                @if (!empty($guest->key))
                    {{ link_to_route('event.showbykey', $guest->name, $guest->key) }}
                @else
                    {{ $guest->name }}
                @endif
            </li>
        @endforeach
    </ul>
@endif
