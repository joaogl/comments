<?php namespace jlourenco\comments\Facades;

use Illuminate\Support\Facades\Facade;

class Comments extends Facade
{

    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'comments';
    }

}
