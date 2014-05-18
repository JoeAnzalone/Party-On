<?php

class UsersController extends \BaseController {


    public function showLogin()
    {
        $this->layout->content = View::make('users.login');
    }

    public function login()
    {
        Sentry::authenticate(Input::only(['email', 'password']));

        return Redirect::to(route('event.mine'))->with(
            'flash',
            ['class' => 'success', 'message' => "Welcome back!"]
        );
    }

    public function logout()
    {
        Sentry::logout();
        return Redirect::to(route('user.show_login'))->with(
            'flash',
            ['class' => 'success', 'message' => 'You have successfully logged out']
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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