<?php namespace jlourenco\comments\Traits;

use Comments;

trait Commentable {

    /**
     * Get all of the comments.
     */
    public function comments()
    {
        return $this->morphMany(Comments::getCommentsRepository()->getModel(), 'entity');
    }

}
