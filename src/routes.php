<?php

/**
 * Frontend route group
 *
 * All the "restricted area" routes
 * are defined here.
 */
Route::group(array('prefix' => '/admin', 'middleware' => ['webAdmin', 'auth']), function ()
{

    # Delete comments
    Route::get('/{commentId}/delete-comment', array('as' => 'delete-comment', 'uses' => 'jlourenco\comments\Controllers\CommentsController@getDelete'));
    Route::get('/{commentId}/confirm-delete-comment', array('as' => 'confirm-delete/comment', 'uses' => 'jlourenco\comments\Controllers\CommentsController@getModalDelete'));

});
