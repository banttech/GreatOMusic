<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsLetterSubscriber;
use Illuminate\Validation\ValidationException;

class SubscribersController extends Controller
{
    public function store(Request $request){
        try {
            $this->validate($request, [
                'email' => 'required|email|unique:email_list,email'
            ], [
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Invalid Email Address!!',
                'email.unique' => 'You have already subscribed!'
            ]);
        
            $subscriber = new NewsLetterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->date = date('Y-m-d H:i:s');
            $subscriber->save();
        
            return response()->json([
                'success' => true,
                'message' => 'Congratulations. You have successfully subscribed to our email list.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ]);
        }
    }

    public function unsubscriber(Request $request){
        try {
            $this->validate($request, [
                'email' => 'required|email'
            ], [
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Invalid Email Address!!'
            ]);
        
            $subscriber = NewsLetterSubscriber::where('email', $request->email)->first();
            if($subscriber){
                $subscriber->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Congratulations. You have successfully unsubscribed from our email list.'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'You are not subscribed!!'
                ]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ]);
        }
    }
}
