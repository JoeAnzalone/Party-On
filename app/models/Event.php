<?php

class Event extends \Eloquent {
    protected $fillable = [];

    public function guests()
    {
        return $this->hasMany('Guest');
    }
}
