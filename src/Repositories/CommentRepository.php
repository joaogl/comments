<?php namespace jlourenco\comments\Repositories;

use Cartalyst\Support\Traits\RepositoryTrait;

class CommentRepository implements CommentRepositoryInterface
{
    use RepositoryTrait;

    /**
     * The comment model name.
     *
     * @var string
     */
    protected $model = 'jlourenco\comments\Models\Comment';

    /**
     * Create a new comment repository.
     *
     * @param  string  $model
     */
    public function __construct($model = null)
    {
        if (isset($model))
            $this->model = $model;
    }

    /**
     * {@inheritDoc}
     */
    public function findById($id)
    {
        return $this
            ->createModel()
            ->newQuery()
            ->find($id);
    }

}
