<?php

use \Michelf\Markdown;

class Event extends \Eloquent {
    protected $fillable = ['title', 'description', 'location', 'start_time', 'end_time'];

    public function __construct($params = [])
    {
        if (isset($params['start_time_date']) && isset($params['start_time_time'])) {
            $params['start_time'] = $params['start_time_date'] . ' ' . $params['start_time_time'];
        }

        return parent::__construct($params);
    }

    public function guests()
    {
        return $this->hasMany('Guest');
    }

    public function getDescriptionAttribute($description)
    {
        return Markdown::defaultTransform($description);
    }
}
