<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Email;

class EmailController extends Controller
{
    //subscribe to mail list
    public function subscribeToMailList(Request $request){
        $input = $request->all();

        if(!$input){
            return \response()->json([
                "status" => 'fail',
                "message" => "cannot subscribewith empty email"
            ]);
        }

        $input['email']= filter_var($input['email'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                "message"=> "invalid email format"
            ], 400);
        }

        $subscribe = Email::create($input);

        return \response()->json([
            'status' => "success",
            'message' => "you have successfuly subscribe to our mailing list",
            'data' => $subscribe
        ]);
    }

    //unsubscribe
    public function unsubscribeFromMail(Request $request){
        $email = $request->email;

        $find = Email::where('email', $email)->first();

        if (!$find) {
            return response()->json([
                'status' => "fail",
                'message' => "You are not a current subscriber to our mail list",
            ]);
        }

        Email::find($find['id'])->delete();

        return response()->json([
            "status" => "success",
            "message" => "succesfully unsubscribed from our mail list. You will no longer receive any update of our new events or blog post again"
        ]);
    }

    // send function
    public function email($data){
        $verificationFunction = function($message)use($data){
            $message->to($data["email"]);
            $message->subject("New issue out check our blog post");
        };

        Mail::send('verificationCode', $data, $verificationFunction);
    }
    
    //send mail
    public function sendMail(Request $request){
        $allMail = Email::all();
        $content = $request->message;

        foreach($allMail as $mail) {
            $data = [
                "email" => $mail->mail,
                "data" => $content
            ];
            email($data);
        }

        return \response()->json([
            "status" => "success",
            "message" => "mail sent succesfully"
        ]);
    }
}
