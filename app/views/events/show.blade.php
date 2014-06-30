<h1 class="title">{{ $event['title'] }}</h1>
<div class="start_time">On {{ $event->nice_start_time }}</div>
<div class="google-calendar-link">[<a href="{{ $event->google_calendar_url }}" target="_blank">Add to Google Calendar</a>]</div>

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

@if (!empty($event->location_name) || !empty($event->location_address))
    <div class="location" data-location="{{ $event->location_address }}">
        <h2>Location</h2>
        <h3 class="location-name">{{ $event->location_name }}</h3>
        @if (!empty($event->location_address))
            <a class="location-address" href="{{ $event->location_url }}" title="Open in Google Maps" target="_blank">{{ $event->location_address }}</a>
            <div id="map" class="map"></div>
        @endif
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
                @foreach ($guests as $thisGuest)
                    <li>
                        {{ $thisGuest->getAvatar() }}
                        <span class="name">{{ $thisGuest->name }}</span>
                        @if (!empty($guest) && $thisGuest->id == $guest->id)
                            <span class="you">(That's you!)</span>
                        @endif
                        @if (!empty($thisGuest->key))
                            <span class="invite-link"> - {{ link_to_route('event.showbykey', 'Invite link', [$thisGuest->key, $event->slug]) }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endforeach
@endif
