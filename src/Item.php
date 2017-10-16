<?php

namespace Alegra;

use Alegra\Support\Attachment;

final class Item extends Resource
{
    /**
     * Transform attributes when receive the resource
     *
     * @var array
     */
    protected $fillable = [
        'name'        => 'string',
        'type'        => 'string',
        'description' => 'string',
        'reference'   => 'string',
        'status'      => 'string',
        'category'    => Category::class,
        'price'       => Item\Price::collection, // this is a collection of Price
        'tax'         => Tax::collection, // this a collection of Tax
        'inventory'   => Item\Inventory::class,
        'images'      => Attachment::collection,
        'attachments' => Attachment::collection
    ];

    /**
     * Add ability for support metadata
     */
    use Support\Metadata;

    /**
     * Add ability for support attach file
     */
    use Support\Attachable {
        prepareFile as _prepareFile;
    }

    protected static function prepareFile($file)
    {
        $opts = static::_prepareFile($file);
        if (static::isImage($opts['contents'])) {
            $opts['name'] = 'image';
        }
        return $opts;
    }
}
