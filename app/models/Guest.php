<?php

class Guest extends \Eloquent {

    const RESPONSE_NONE  = 0;
    const RESPONSE_YES   = 1;
    const RESPONSE_NO    = 2;
    const RESPONSE_MAYBE = 3;

    protected $fillable = ['name', 'email', 'response'];
    protected $appends  = ['response', 'possessive'];

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
        $responses = [
            'awaiting response' => self::RESPONSE_NONE,
            'yes'        => self::RESPONSE_YES,
            'no'         => self::RESPONSE_NO,
            'maybe'      => self::RESPONSE_MAYBE,
        ];

        $this->response_id = $responses[$response_str];

        return $this;
    }

    public function getResponseAttribute()
    {
        if (empty($this->response_id)) {
            $this->response_id = self::RESPONSE_NONE;
        }

        $responses = [
            self::RESPONSE_NONE  => 'awaiting response',
            self::RESPONSE_YES   => 'yes',
            self::RESPONSE_NO    => 'no',
            self::RESPONSE_MAYBE => 'maybe',
        ];

        return $responses[$this->response_id];
    }

    public function getAvatar($size = 50)
    {
        $alt = $this->possessive . ' avatar';
        return HTML::image($this->getAvatarUrl($size), $alt, ['class' => 'avatar']);
    }

    public function getAvatarUrl($size = 50, $options = [])
    {
        $default_options = [
            'size'    => $size,
            'default' => 'identicon',
            'rating'  => 'pg',
        ];

        $options = array_merge($default_options, $options);

        $email = $this->email;
        if (!$email) {
            $options['forcedefault'] = 'y';
            $email = $this->name;
        }

        $base_url = 'https://www.gravatar.com/avatar/';
        $hash = md5( strtolower( trim( $email ) ) );
        $query_string = http_build_query($options);

        return $base_url . $hash . '?' . $query_string;
    }

    public function getNameAttribute($name)
    {
        return !empty($name) ? $name : 'Anonymous Attendee';
    }

    public function getPossessiveAttribute()
    {
        // Get name as possessive
        // http://davidwalsh.name/php-possessive-punctuation
        return $this->name . '\'' . ($this->name[strlen($this->name) - 1] != 's' ? 's' : '');
    }
}
