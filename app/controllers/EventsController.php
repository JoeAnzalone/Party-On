<?php

class EventsController extends \BaseController {

    protected $layout = 'layouts.main';

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
        return Redirect::to(route('event.show', $event->id))->with('message', 'Event saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = ['event' => Event::find($id)];
        $this->layout->content = View::make('events.show', $data);
    }

    public function showByGuestKey($key, $slug = '')
    {
        $guest = Guest::where('key', $key)->firstOrFail()->load('event');
        $this->layout->content = View::make('events.show', $guest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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