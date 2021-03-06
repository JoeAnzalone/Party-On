<?php

class EventsController extends \BaseController
{

    public function __construct()
    {
        $this->beforeFilter('auth', ['except' => ['showByGuestKey']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = Event::all();
        $this->layout->content = View::make('events.index', ['events' => $events]);
    }

    public function currentUser()
    {
        try {
            $events = Event::where('user_id', Sentry::getUser()->id)->get();
        } catch (Exception $e) {
            return Redirect::to(route('user.show_login'))->with(
                'flash',
                ['class' => 'success', 'message' => 'You must be logged in to do that.']
            );
        }

        $this->layout->content = View::make('events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [];
        $this->layout->content = View::make('events.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $event = new Event();
        $event->user()->associate(User::loggedIn());
        $event->fill(Input::except('_token'));

        User::loggedIn()->events()->save($event);

        return Redirect::to(route('event.show', $event->id))->with(
            'flash',
            ['class' => 'success', 'message' => 'Event saved.']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->layout->styles  .= HTML::style('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css');
        $this->layout->styles  .= HTML::style('/css/events.show.css');
        $this->layout->scripts .= HTML::script('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js');
        $this->layout->scripts .= HTML::script('/js/events.show.js');

        $event = Event::find($id)->load('guests');
        $data = ['event' => $event];

        $host = new Guest();
        $host->fill(['name' => $event->user->name, 'email' => $event->user->email, 'response' => 'yes']);
        $data['event']->guests->prepend($host);
        $this->layout->title = $event->title;
        $this->layout->content = View::make('events.show', $data);
    }

    public function showByGuestKey($key, $slug = '')
    {
        $this->layout->styles  .= HTML::style('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css');
        $this->layout->styles  .= HTML::style('/css/events.show.css');
        $this->layout->scripts .= HTML::script('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js');
        $this->layout->scripts .= HTML::script('/js/events.show.js');

        $guest = Guest::where('key', $key)->firstOrFail();
        $event = $guest->event;

        $event->guests->each(function ($item) {
            unset($item->key);
        });

        $data = [
            'guest' => $guest,
            'event' => $event,
        ];

        $host = new Guest();
        $host->fill(['name' => $event->user->name, 'email' => $event->user->email, 'response' => 'yes']);
        $data['event']->guests->prepend($host);
        $this->layout->title = $event->title;
        $this->layout->content = View::make('events.show', $data);
    }

    public function showIcal($key)
    {
        $guest = Guest::where('key', $key)->firstOrFail();
        $event = $guest->event;

        $event->guests->each(function ($item) {
            unset($item->key);
        });

        $data = [
            'guest' => $guest,
            'event' => $event,
        ];

        $host = new Guest();
        $host->fill(['name' => $event->user->name, 'email' => $event->user->email, 'response' => 'yes']);
        $data['event']->guests->prepend($host);

        $response = Response::view('events.show_ical', $data);
        $response->header('Content-Type', 'text/calendar');
        $response->header('Content-Disposition', 'attachment; filename="' . $event->slug . '"');
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $this->layout->title = 'Edit: ' . $event->title;
        $this->layout->content = View::make('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $event = Event::findOrFail($id);
        $event->update(Input::except('_token'));

        return Redirect::to(route('event.show', $event->id))->with(
            'flash',
            ['class' => 'success', 'message' => 'Event updated.']
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
