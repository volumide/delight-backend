<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leaders;

class LeadersController extends Controller
{
	//create leader's profile
    public function createLeaderProfile(Request $request){
    	$input = $request->all();

    	Leaders::create($input);
    	return response()->json([
    		"status" => "success",
			"message" => "profile created successfully"
		]);
    }

    //update leader's profile by id
    public function updateLeaderProfile(Request $request, $id){
    	$input = $request->all();
    	Leaders::where('id', $id)->update($input);
    	return response()->json([
    		"status" => "success",
    		"message" => "profile updated successfully"
    	]);
    }

    //delete leader's profile
    public function removeLeaderProfile($id){
    	$leader = Leaders::find($id);

    	if(!$leader) {
    		return response()->json([
    			"status" => "fail",
    			"message" => "profile not found"
    		], 404);    	
    	}

    	$leader->delete();
		return response()->json([
    		"status" => "success",
    		"message" => "profile deleted successfully"
    	]);
    }

    //get all leaders
    public function getLeaders(){
		$leaders = Leaders::all();

		if(!$leaders){
			return response()->json([
				"status" => "success",
				"message" => "No leader record found"
			]);
		}
    	return response()->json([
    		"status" => "success",
    		"data" => $leaders
    	]);
    }

    //get leaders by id 
    public function getLeaderProfile($id){

     	$leader = Leaders::find($id);

     	if(!$leader){
     		return response()->json([
	    		"status" => "fail",
	    		"message" => "not found"
	    	]);
     	}
    	return response()->json([
    		"status" => "success",
    		"data" => $leader
    	]);
    }
}



