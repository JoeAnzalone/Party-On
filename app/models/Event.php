<?php

use \Michelf\Markdown;

class Event extends \Eloquent {
    protected $fillable = ['title', 'description', 'location', 'start_time', 'end_time'];
    protected $appends  = ['description_html'];

    public function __construct($params = [])
    {
        if (isset($params['start_time_date']) && isset($params['start_time_time'])) {
            $params['start_time'] = $params['start_time_date'] . ' ' . $params['start_time_time'];
        }

        if (isset($params['guests_string'])) {
            $this->addGuestsAsString($params['guests_string']);
        }

        return parent::__construct($params);
    }

    public function guests()
    {
        return $this->hasMany('Guest');
    }

    public function addGuestsAsString($string)
    {
        $this->save();
        $guests_strings = explode("\n", trim($string));
        foreach ($guests_strings as $guest_str) {
            $guest = new Guest;
            $guest->populateByString($guest_str);
            $this->guests()->save($guest);
            $guests[] = $guest;
        }

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

    public function getStartTimeDateAttribute()
    {
        return date('Y-m-d', strtotime($this->start_time));
    }

    public function getStartTimeTimeAttribute()
    {
        return date('H:i:s', strtotime($this->start_time));
    }
}
