<?php

class Guest extends \Eloquent {
    protected $fillable = [];

    public function __construct()
    {
        Guest::creating(function($guest){
            $guest->onCreating();
        });
    }

    public function event()
    {
        return $this->belongsTo('Event');
    }

    public function populateByString($guest_str)
    {
        if (strpos($guest_str, '<') !== false) {
            // Contains email and name
            preg_match('#(.+) (?:<(.+)>)?#', $guest_str, $matches);
            $this->name  = !empty($matches[1]) ? trim($matches[1]) : null;
            $this->email = !empty($matches[2]) ? trim($matches[2]) : null;
            return;
        } else {
            // Contains only name
            $this->name  = trim($guest_str);
            $this->email = null;
            return;
        }
    }

    public function onCreating()
    {
        if (empty($this->key)) {
            $this->key = sha1($this->email . $this->event_id . microtime() . Config::get('app.key'));
        }
  }
}
