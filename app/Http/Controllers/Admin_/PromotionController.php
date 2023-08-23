<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\PromotionMail;
use App\Models\ContactUs;

class PromotionController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Promotion";
        return view('admin.promotion.index');
    }

    public function sendPromotionEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sent_to' => 'required',
            'email_body' => 'required',
            'email_from' => 'required',
        ], [
            'sent_to.required' => 'Sent To field is required',
            'email_body.required' => 'Email Body field is required',
            'email_from.required' => 'Email From field is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $promotion = new Promotion();
        $promotion->sent_to = $request->sent_to;
        $promotion->email_body = $request->email_body;
        $promotion->email_from = $request->email_from;
        $promotion->save();

        // break the $request->sent_to from @ and get the username
        $username = explode('@', $request->sent_to)[0];
        $data = [
            // do first letter uppercase for name
            'name' => ucfirst($username),
            'body' => $request->email_body,
            'email' => $request->sent_to,
            'subject' => 'Great "O" Music | Promotion',
        ];
        // send welcome email to user
        // Mail::send(new PromotionMail($data));

        $send_mail = ContactUs::first()->send_mail;
        Mail::send(new PromotionMail($data),[$send_mail], function ($m) {
            $m->from($send_mail, 'Great "O" Music');
        });

        return redirect()->back()->with('success', 'Promotion email sent successfully');
    }
}
