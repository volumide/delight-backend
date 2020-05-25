<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Blog;

class CommentController extends Controller
{
	// comment on a post
    public function newComment(Request $request){
    	$input = $request->all();

    	$search = Blog::where('id', $input['blog_id'])->first();

    	if (!$search) {
    		return response()->json([
	    		"status" => "fail",
	    		"message" => "blog not found"
	    	]);
    	}

    	Comment::create($input);
    	return response()->json([
    		"status" => "success",
    		"message" => "Blog created successfully"
    	]);
    }

    // admin delete comment
    public function removeComment(Request $request){
    	$comment= Comment::find($id);

    	if (!$comment) {
			return response()->json([
	    		"status" => "fail",
	    		"message" => "not found"
	    	], 404);
    	}

    	$comment->delete();

    	return response()->json([
    		"status" => "success",
    		"message" => "Deleted successfully"	
	    ]);
    }

    //get comments based on blog post id
    public function getComment($id){
    	$comments = Comment::where('blog_id', $id)->get();

    	if (!$comments) {
			return response()->json([
	    		"status" => "fail",
	    		"message" => "no comment found"
	    	]);
    	}

		return response()->json([
    		"status" => "success",
    		"message" => "comments retrived",
    		"data" => $comments
    	]);
    }
}
