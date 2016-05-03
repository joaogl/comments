<?php namespace jlourenco\comments;

use Illuminate\Support\ServiceProvider;
use jlourenco\comments\Repositories\CommentRepository;

class commentsServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->prepareResources();
        $this->registerComment();
        $this->registerComments();
        $this->registerToAppConfig();
    }

    /**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {
        // Publish our views
        $this->loadViewsFrom(base_path("resources/views"), 'base');
        $this->publishes([
            __DIR__ .  '/views' => base_path("resources/views")
        ]);

        // Publish our migrations
        $this->publishes([
            __DIR__ .  '/migrations' => base_path("database/migrations")
        ], 'migrations');

        // Publish a config file
        $this->publishes([
            __DIR__ . '/config' => base_path('/config')
        ], 'config');

        // Publish our routes
        $this->publishes([
            __DIR__ .  '/routes.php' => base_path("app/Http/comments_routes.php")
        ], 'routes');

        // Include the routes file
        if(file_exists(base_path("app/Http/comments_routes.php")))
            include base_path("app/Http/comments_routes.php");
    }

    /**
     * Registers the blog posts.
     *
     * @return void
     */
    protected function registerComment()
    {
        $this->app->singleton('jlourenco.comments.comment', function ($app) {
            $baseConfig = $app['config']->get('jlourenco.base');
            $config = $app['config']->get('jlourenco.comments');

            $model = array_get($config, 'models.comment');
            $users = array_get($baseConfig, 'models.User');

            if (class_exists($model) && method_exists($model, 'setUsersModel'))
                forward_static_call_array([$model, 'setUsersModel'], [$users]);

            return new CommentRepository($model);
        });
    }

    /**
     * Registers log.
     *
     * @return void
     */
    protected function registerComments()
    {
        $this->app->singleton('comments', function ($app) {
            $blog = new Comments($app['jlourenco.comments.comment']);

            return $blog;
        });

        $this->app->alias('comments', 'jlourenco\comments\Comments');
    }

    /**
     * Registers this module to the
     * services providers and aliases.
     *
     * @return void
     */
    protected function registerToAppConfig()
    {
        /*
         * Create aliases for the dependencies.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Comments', 'jlourenco\comments\Facades\Comments');
    }

    /**
     * {@inheritDoc}
     */
    public function provides()
    {
        return [
            'jlourenco.comments.comment',
            'comments'
        ];
    }

}