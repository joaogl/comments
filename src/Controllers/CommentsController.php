<?php namespace jlourenco\comments\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Blog;
use Sentinel;
use Searchy;
use Input;
use Comments;
use Base;
use Lang;
use Redirect;

class CommentsController extends Controller
{

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
        $confirm_route = $error = null;

        $title = 'Delete comment';
        $message = 'Are you sure to delete this comment?';

        // Get post information
        $comment = Comments::getCommentsRepository()->findOrFail($id);

        if ($comment == null)
        {
            // Prepare the error message
            $error = Lang::get('comments.comment.not_found');
            return View('layouts.modal_confirmation', compact('title', 'message', 'error', 'model', 'confirm_route'));
        }

        $confirm_route = route('delete/comment', ['id' => $comment->id]);
        return View('layouts.modal_confirmation', compact('title', 'message', 'error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given comment.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function getDelete($id = null)
    {
        // Get comment information
        $comment = Comments::getCommentsRepository()->find($id);

        if ($comment == null)
        {
            // Prepare the error message
            $error = Lang::get('comments.comment.not_found');

            // Redirect to the post management page
            return Redirect::route('posts')->with('error', $error);
        }

        Base::Log('Comment (' . $comment->id . ') was deleted.');

        // Delete the post
        $comment->delete();

        // Prepare the success message
        $success = Lang::get('comments.comment.deleted');

        // Redirect to the post management page
        return Redirect::back()->with('success', $success);
    }

}
