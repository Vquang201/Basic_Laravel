<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        $post_users = User::select('user_id', 'users.name')
            ->selectRaw('COUNT(*) AS post_count')
            ->join('food', 'users.id', '=', 'food.user_id')
            ->groupBy('user_id', 'users.name')
            ->orderByDesc('post_count')
            ->limit(3)
            ->get();

        $likes = Like::select('comment_id', 'comments.content')
            ->selectRaw('COUNT(*) AS comment_count')
            ->join('comments', 'likes.comment_id', '=', 'comments.id')
            ->where('liked', '=', 1)
            ->groupBy('comment_id', 'comments.content')
            ->orderByDesc('comment_count')
            ->limit(3)
            ->get();

        // $likes = Like::with('comments')
        //     ->select('comment_id', 'comments.content')
        //     ->selectRaw('COUNT(*) AS comment_count')
        //     ->where('liked', '=', 1)
        //     ->groupBy('comment_id', 'comments.content')
        //     ->orderByDesc('comment_count')
        //     ->limit(3)
        //     ->get();

        // return dd($likes);

        // get người comment 
        $user_comment_of_like = [];
        foreach ($likes as $key => $value) {
            $comment = Comment::find($value->comment_id);

            if (!empty($comment)) {
                $user = User::find($comment->user_id);
                array_push($user_comment_of_like, ['comment' => $comment, 'user' => $user]);
            }
        }

        $dislike = Like::select('comment_id', 'comments.content')
            ->selectRaw('COUNT(*) AS comment_count')
            ->join('comments', 'likes.comment_id', '=', 'comments.id')
            ->where('disliked', '=', 1)
            ->groupBy('comment_id', 'comments.content')
            ->orderByDesc('comment_count')
            ->limit(3)
            ->get();

        // get người comment 
        $user_comment_of_dislike = [];
        foreach ($dislike as $key => $value) {
            $comment = Comment::find($value->comment_id);

            if (!empty($comment)) {
                $user = User::find($comment->user_id);
                array_push($user_comment_of_dislike, ['comment' => $comment, 'user' => $user]);
            }
        }

        return view('/welcome', compact('post_users', 'likes', 'user_comment_of_like',  'dislike', 'user_comment_of_dislike'));
    }
}
