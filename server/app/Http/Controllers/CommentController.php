<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    public function index(Request $request)
    {
        $comments = Comment::where('message_id',(int)$request->id)->orderBy('created_at', 'desc')->get();
        return response()->json($comments);
    }

    public function store(Request $request)
    {

        $comment = Comment::create([
            'message_id' => $request->id,
            'comment' => $request->comment
        ]);


        return response()->json($comment);
    }
}
