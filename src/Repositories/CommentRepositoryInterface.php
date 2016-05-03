<?php namespace jlourenco\comments\Repositories;

interface CommentRepositoryInterface
{

    /**
     * Finds a comment category by the given primary key.
     *
     * @param  int  $id
     * @return \jlourenco\comments\Models\Comment
     */
    public function findById($id);

}
