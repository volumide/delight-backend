<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use App\Event;
use App\Leaders;
use App\Comment;
class BlogController extends Controller
{
	//create new blog
    public function newBlog(Request $request){
    	$input = $request->all();

    	$create = Blog::create($input);
    	return response()->json([
    		"status" => "success",
			"message" => "Blog created successfully",
			"data" => $create
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
    		"status" => "success",
			"message" => "Updated successfully",
			"data" => Blog::find($id)
    	]);
	}
	
	public function dataCount(){
		return \response()->json([
			"status" => "success",
			"event" => count(Event::all()),
			"profile" => count(Leaders::all()),
			"blog" => count(Blog::all()),
			"comment" => count(Comment::all()),
		]);
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
	
	public function uploadImage(Request $request){
		$file_name = rand(). "".  $request->image->getClientOriginalName();

        $upload =  $request->image->move(storage_path('app/public/'), $file_name);
		$url = \getenv("APP_URL") . "" . Storage::url('app/public/'.$file_name);

		return response()->json([
			"name" => $file_name,
			"size" => getimagesize($url),
			"url"=> $url,
		]);
	}

	// public function uploadFile(Request $request){
	// 	$file = $request->file('image')->getClientOriginalName();
	// 	$storagePath = Storage::disk('public')->put($file, $file);
	// 	$url = Storage::disk('public')->url($file);
	// 	// $size = Storage::size($file);

	// 	return response()->json([
	// 		// "size" => $size,
	// 		"url" => $url
	// 	]);
	// }
}
