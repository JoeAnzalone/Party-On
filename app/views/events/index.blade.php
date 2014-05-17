<ul class="events">
@foreach ($events as $event)
    <li>
    {{ link_to_route('event.show', $event->title, $event->id) }}
    </li>
@endforeach
</ul>
