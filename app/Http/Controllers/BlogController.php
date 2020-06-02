<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use App\Event;
use App\Leaders;
use App\Comment;
use App\Gallery;
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

		if(count($blogs) < 1){
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

	public function postPictureToGallery(Request $request){
		$input = $request->all();

		$create = Gallery::create($input);

    	return response()->json([
    		"status" => "success",
			"message" => "Blog created successfully",
			"data" => Gallery::find($create->id)
    	]);
	}

	public function getAllGalleryPictures(){
		$gallery = Gallery::all();

		if(count($gallery) < 1){
			return response()->json([
				"status" => 'success',
				"message" => 'Picture in gallery'
			]);
		}

    	return response()->json([
			"status" => 'success',
			"message" => "picture retrieved successfully",
    		"data" => $gallery
    	]);
	}

	public function getPicture($id){
    	$gallery = Gallery::find($id);

    	if(!$blog){
    		return response()->json([
	    		"status" => 'fail',
	    		"message" => "not found"
	    	], 404);
	    }

	    return response()->json([
    		"status" => 'success',
    		"data" => $gallery
    	]);
	}

	public function removePictureFromGallery($id){
		$gallery = Gallery::find($id);

    	if (!$gallery) {
			return response()->json([
	    		"status" => "fail",
	    		"message" => "not found"
	    	], 404);
    	}

    	$gallery->delete();

    	return response()->json([
    		"status" => "success",
    		"message" => "Deleted successfully"
	    ]);
	}

	public function uploadImage(Request $request){

		if (is_null($request->image)) {
			return null;
		}

		$file_name = rand(). "".  $request->image->getClientOriginalName();

        $upload =  $request->image->move(storage_path('app/public/'), $file_name);
		$url = \getenv("APP_URL") . "" . Storage::url('app/public/'.$file_name);

		return response()->json([
			"name" => $file_name,
			"size" => getimagesize($url),
			"url"=> $url,
		]);
	}


}
