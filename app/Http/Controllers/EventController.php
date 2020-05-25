<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    //create new event
    public function newEvent(Request $request){
    	$input = $request->all();

    	Event::create($input);
    	return response()->json([
    		"status" => "success",
    		"message" => "Event created successfully"
    	]);
    }

    //delete event
    public function removeEvent($id){
    	$blog = Event::find($id);

    	if (!$blog) {
			return response()->json([
	    		"status" => "fail",
	    		"message" => "not found"
	    	], 404);
    	}

    	$blog->delete();

    	return response()->json([
    		"status" => "success",
    		"message" => "event removed successfully"
	    ]);
    }

	//modify blog content by id
    public function editEvent(Request $request, $id){
    	$input = $request->all();
		$blog = Event::find($id);

		if (!$blog) {
			return response()->json([
	    		"status" => "fail",
	    		"message" => "not found"
	    	], 404);
    	}

    	Event::where('id', $id)->update($input);
    	return response()->json([
    		"status" => "fail",
    		"message" => "not found"
    	], 404);
    }

    //get all events 
    public function getAllEvents(){
		$events = Event::all();

		if(!$events){
			return response()->json([
				"status" => "success",
				"message" => "No current event"
			]);
		}

    	return response()->json([
    		"status" => 'success',
    		"data" => $events
		]);
		
    }

    //get event by id
    public function getEvent($id){
    	$event = Event::find($id);

    	if(!$blog){
    		return response()->json([
	    		"status" => 'fail',
	    		"message" => "not found"
	    	], 404);
	    }

	    return response()->json([
    		"status" => 'success',
    		"data" => $event
    	]);
    }
}
