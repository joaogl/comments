<?php namespace jlourenco\comments;

use jlourenco\comments\Repositories\CommentRepositoryInterface;

class Comments
{

    /**
     * The Comments repository.
     *
     * @var \jlourenco\comments\Repositories\CommentRepositoryInterface
     */
    protected $comments;

    /**
     * Create a new Blog instance.
     *
     * @param  \jlourenco\comments\Repositories\CommentRepositoryInterface  $comments
     */
    public function __construct(CommentRepositoryInterface $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Returns the comments repository.
     *c
     * @return \jlourenco\comments\Repositories\CommentRepositoryInterface
     */
    public function getCommentsRepository()
    {
        return $this->comments;
    }

    /**
     * Sets the comments repository.
     *
     * @param  \jlourenco\comments\Repositories\CommentRepositoryInterface $comments
     * @return void
     */
    public function setCommentsRepository(CommentRepositoryInterface $comments)
    {
        $this->comments = $comments;
    }

}
