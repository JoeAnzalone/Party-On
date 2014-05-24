<h1 class="title">{{ $event['title'] }}</h1>
<div class="start_time">On {{ $event->nice_start_time }}</div>

@if (!empty($guest['key']))
    <div class="respond">
        @if ($guest['response'] != 'none')
        <span class="label">Your RSVP:</span>
        @else
        <span class="label">RSVP here:</span>
        @endif

        @if ($guest['response'] != 'yes')   {{ link_to_route('guest.edit_response', 'Yes ✓',   [$guest['key'], 'yes']) }}   @else <span class="selected">Yes ✓</span>   @endif
        @if ($guest['response'] != 'no')    {{ link_to_route('guest.edit_response', 'No ✗',    [$guest['key'], 'no']) }}    @else <span class="selected">No ✗</span>    @endif
        @if ($guest['response'] != 'maybe') {{ link_to_route('guest.edit_response', 'Maybe ?', [$guest['key'], 'maybe']) }} @else <span class="selected">Maybe ?</span> @endif
    </div>
@endif

<div class="description">{{ $event->description_html }}</div>

@if (!empty($event->location))
    <div class="location" data-location="{{ $event->location }}">
        <h2>Location</h2>
        <a href="{{ $event->location_url }}" title="Open in Google Maps" target="_blank">{{ $event->location }}</a>
        <div id="map" class="map"></div>
    </div>
@endif

@if ($event->end_time)
<h2>End Time</h2>
<div class="end_time">{{ $event->nice_end_time }}</div>
@endif

@if ($event->guestsByResponse())
    <h2>Guests</h2>
        @foreach ($event->guestsByResponse() as $response => $guests)
            <h3>{{ $response }}</h3>
            <ul class="guests">
                @foreach ($guests as $guest)
                    <li>
                        {{ $guest->getAvatar() }}
                        <span class="name">{{ $guest->name }}</span>
                        @if (!empty($guest->key))
                            <span class="invite-link"> - {{ link_to_route('event.showbykey', 'Invite link', [$guest->key, $event->slug]) }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endforeach
@endif
