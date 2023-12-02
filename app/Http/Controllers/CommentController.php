<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){

          $validator = validator(request()->all(), [
                'content' => 'required',
              
                ]);
        if($validator->fails()) {

            return back()->withErrors($validator);

          }
        
      
        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        
        $comment->save();

        return back()->with('CmtCreate', 'Comment Create Successfully!');

    }

    public function delete($id)
    {
        // $comment = Comment::find($id);

        // if(Gate::allows('comment-delete', $comment)) 
        // {
        //     $comment->delete();
        //     return back()->with('CmtDel', 'Comment Deleted!');
        // } else {
        //     return back()->with('Auth', 'You Cannot Delete This Comment!');
        // }

        $comment = Comment::find($id);

        if(Gate::denies('comment-delete', $comment)) {

        return back()->with('Auth', 'Unauthorize'); 

        }

        $comment->delete();
        return back()->with('CmtDel', 'Comment Deleted!');

        

        
    }
}