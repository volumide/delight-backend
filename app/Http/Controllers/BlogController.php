<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
	//create new blog
    public function newBlog(Request $request){
    	$input = $request->all();

    	Blog::create($input);
    	return response()->json([
    		"status" => "success",
    		"message" => "Blog created successfully"
    	]);
    }

    //modify blog content
    public function editBlog(Request $request, $id){
    	$input = $request->all();
		$blog = Blog::find($id);

		if (!$blog) {
			return response()->json([
	    		"status" => "fail",
	    		"message" => "not found"
	    	], 404);
    	}

    	Blog::where('id', $id)->update($input);
    	return response()->json([
    		"status" => "fail",
    		"message" => "not found"
    	], 404);
    }

    //delete blog admin
    public function removeBlog($id){
    	$blog = Blog::find($id);

    	if (!$blog) {
			return response()->json([
	    		"status" => "fail",
	    		"message" => "not found"
	    	], 404);
    	}

    	$blog->delete();

    	return response()->json([
    		"status" => "success",
    		"message" => "Deleted successfully"
	    ]);
    }

    public function getAllBlog(){
		$blogs = Blog::all();

		if(!$blogs){
			return response()->json([
				"status" => 'success',
				"message" => 'No blog created come back later'
			]);
		}

    	return response()->json([
    		"status" => 'success',
    		"data" => Blog::all()
    	]);
    }

    public function getBlog($id){
    	$blog = Blog::find($id);

    	if(!$blog){
    		return response()->json([
	    		"status" => 'fail',
	    		"message" => "not found"
	    	], 404);
	    }

	    return response()->json([
    		"status" => 'success',
    		"data" => $blog
    	]);
    }

}
