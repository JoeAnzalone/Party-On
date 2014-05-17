<?php

use \Michelf\Markdown;

class Event extends \Eloquent {
    protected $fillable = ['title', 'description', 'location', 'start_time', 'end_time'];

    public function guests()
    {
        return $this->hasMany('Guest');
    }

    public function getDescriptionAttribute($description)
    {
        return Markdown::defaultTransform($description);
    }
}
