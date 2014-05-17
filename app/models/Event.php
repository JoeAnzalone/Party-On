<?php

use \Michelf\Markdown;

class Event extends \Eloquent {
    protected $fillable = [];

    public function guests()
    {
        return $this->hasMany('Guest');
    }

    public function getDescriptionAttribute($description)
    {
        return Markdown::defaultTransform($description);
    }
}
