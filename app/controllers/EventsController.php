<?php

class EventsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', ['except' => ['show', 'showByGuestKey']]);
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
        $event = new Event(Input::except('_token'));
        $event->save();

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

        $data = ['event' => Event::find($id)->load('guests')];
        $this->layout->content = View::make('events.show', $data);
    }

    public function showByGuestKey($key, $slug = '')
    {
        $this->layout->styles  .= HTML::style('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css');
        $this->layout->styles  .= HTML::style('/css/events.show.css');
        $this->layout->scripts .= HTML::script('http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js');
        $this->layout->scripts .= HTML::script('/js/events.show.js');

        $guest = Guest::where('key', $key)->firstOrFail()->load('event');
        $event = $guest->event->load('guests');

        $data = [
            'guest' => $guest,
            'event' => $event,
        ];

        $this->layout->content = View::make('events.show', $data);
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