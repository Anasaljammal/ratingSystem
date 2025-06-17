<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //Create Comment Function
    public function createComment(Post $post, CommentRequest $commentRequest)
    {
        $user = Auth::guard('user')->user();

        Comment::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment' => $commentRequest->comment,
        ]);

        return redirect()->back()->with('success', 'your comment added successfully');
    }

    //Delete Comment Function
    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'your coment deleted successfully');
    }
}
