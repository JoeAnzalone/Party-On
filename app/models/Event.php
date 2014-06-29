<?php

use \Michelf\Markdown;

class Event extends \Eloquent {
    protected $fillable = ['title', 'description', 'location_name', 'location_address', 'start_time', 'start_time_date', 'start_time_time', 'end_time', 'end_time_date', 'end_time_time', 'guests_string'];
    protected $appends  = ['slug', 'description_html'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function guests()
    {
        return $this->hasMany('Guest');
    }

    public function guestsByResponse()
    {
        foreach ($this->guests as $guest) {
            $response = ucwords($guest->response);
            $results[$response][] = $guest;
        }

        return $results;
    }

    public function setGuestsStringAttribute($string)
    {
        $this->save();
        $guests_strings = explode("\n", trim($string));
        $guests_strings = array_filter($guests_strings);

        foreach ($guests_strings as $guest_str) {
            $guest = new Guest;
            $guest->populateByString($guest_str);

            $this->guests()->save($guest);
        }
    }

    public function getSlugAttribute()
    {
        $slug = trim(strtolower($this->title));
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace( '/[^a-z0-9_-]/', '', $slug );

        return strtolower($slug);
    }

    public function getDescriptionHtmlAttribute()
    {
        return Markdown::defaultTransform($this->description);
    }

    public function getNiceStartTimeAttribute()
    {
        return date('l F jS, Y @ g:ia', strtotime($this->start_time));
    }

    public function getNiceEndTimeAttribute()
    {
        return date('l F jS, Y @ g:ia', strtotime($this->end_time));
    }

    public function setStartTimeDateAttribute($date)
    {
        $timestamp = strtotime($date . ' ' . $this->start_time_time);
        unset($this->start_time_date);
        $this->start_time = date('Y-m-d H:i:s', $timestamp);
    }

    public function setStartTimeTimeAttribute($time)
    {
        $timestamp = strtotime($this->start_time_date . ' ' . $time);
        unset($this->start_time_time);
        $this->start_time = date('Y-m-d H:i:s', $timestamp);
    }

    public function getStartTimeDateAttribute()
    {
        return date('Y-m-d', strtotime($this->start_time));
    }

    public function getStartTimeTimeAttribute()
    {
        return date('H:i:s', strtotime($this->start_time));
    }

    public function getLocationUrlAttribute()
    {
        $url  = 'https://www.google.com/maps/search/';
        $url .=  urlencode($this->location_address);
        $url .= !empty($this->location_name) ? ' (' . urlencode($this->location_name) . ')' : '';

        return $url;
    }
}
