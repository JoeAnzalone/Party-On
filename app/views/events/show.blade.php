<h1>{{ $event['title'] }}</h1>

<div class="description">{{ $event->description_html }}</div>

<h2>Location</h2>
<div class="location" data-location="{{ $event->location }}"><a href="{{ $event->location_url }}" title="Open in Google Maps" target="_blank">{{ $event->location }}</a></div>
<div id="map" class="map"></div>

<h2>Start Time</h2>
<div class="start_time">{{ $event->nice_start_time }}</div>

@if ($event->end_time)
<h2>End Time</h2>
<div class="end_time">{{ $event->nice_end_time }}</div>
@endif

@if (!empty($guest['key']))
    <h2>Your current response: <strong>{{ $guest['response'] }}</strong></h2>
    Change it here:
    {{ link_to_route('guest.edit_response', 'Yes', [$guest['key'], 'yes']) }} /
    {{ link_to_route('guest.edit_response', 'No', [$guest['key'], 'no']) }} /
    {{ link_to_route('guest.edit_response', 'Maybe', [$guest['key'], 'maybe']) }}
@endif

@if (!empty($event->guests))
    <h2>Guests</h2>
    <ul class="guests">
        @foreach ($event['guests'] as $guest)
            <li>
                @if (!empty($guest->key))
                    {{ link_to_route('event.showbykey', $guest->name, $guest->key) }} - {{ $guest->response }}
                @else
                    {{ $guest->name }} - {{ $guest->response }}
                @endif
            </li>
        @endforeach
    </ul>
@endif
