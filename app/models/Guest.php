<?php

class Guest extends \Eloquent {

    const RESPONSE_NONE  = 0;
    const RESPONSE_YES   = 1;
    const RESPONSE_NO    = 2;
    const RESPONSE_MAYBE = 3;

    protected $fillable = [];
    protected $appends  = ['response'];

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

    public function setResponseAttribute($response_str)
    {
        $constant = strtoupper($response_str);
        $constant = 'RESPONSE_' . $constant;

        $this->response_id = constant('self::' . $constant);

        return $this;
    }

    public function getResponseAttribute()
    {
        if (empty($this->response_id)) {
            $this->response_id = self::RESPONSE_NONE;
        }

        $responses = [
            self::RESPONSE_NONE  => 'none',
            self::RESPONSE_YES   => 'yes',
            self::RESPONSE_NO    => 'no',
            self::RESPONSE_MAYBE => 'maybe',
        ];

        return $responses[$this->response_id];
    }
}
