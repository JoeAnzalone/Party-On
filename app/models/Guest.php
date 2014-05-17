<?php

class Guest extends \Eloquent {
    protected $fillable = [];

    public function event()
    {
        return $this->belongsTo('Event');
    }
}
