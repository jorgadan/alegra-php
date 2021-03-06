<?php

namespace Alegra\Support;

class Identification extends \Illuminate\Api\Resource\Model
{
    protected $fillable = [
        'type'   => 'string',
        'number' => 'string',
        'dv'     => 'string'
    ];

    /**
     * Create a new price.
     *
     * @param  mixed    $attributes
     * @return void
     */
    public function __construct($attributes = [])
    {
        if (is_string($attributes)) {
            $attributes = [
                'number' => $attributes,
                'type'   => '',
                'dv'     => ''
            ];
        }

        parent::__construct($attributes);
    }

    protected static function visible()
    {
        return ['*'];
    }
}
