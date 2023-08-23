<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\MusicTitle;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Illuminate\Support\Facades\Mail;
use App\Mail\LicenseDetailMail;
use App\Models\ContactUs;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $stripeApiKey = env('STRIPE_SECRET_KEY');
        // Set the Stripe API key
        Stripe::setApiKey($stripeApiKey);

        $cart_item = $request->cart_item;
        $item = Cart::where('id', $cart_item)->first();
        $coupon_discount = 0;
        if ($item->coupon_discount != null) {
            $coupon_discount = $item->coupon_discount;
        }
        $price = $item->price;
        $totalPrice = $price;
        if ($coupon_discount > 0) {
            $totalPrice = $price - $coupon_discount;
        }
        $totalPrice = $totalPrice * 100;

        try {
            $email = User::where('id', $item->user_id)->first()->email;
            // Create a new customer in Stripe
            $customer = Customer::create(array(
                'email' => $email,
                'source'  => $request->stripeToken
            ));

            $customerId = $customer->id;

            $charge = Charge::create([
                'amount' => $totalPrice,
                'currency' => 'usd',
                'customer' => $customerId,
                'description' => 'GOM Checkout',
            ]);

            $customer = Customer::retrieve($customerId);
            $payerEmail = $customer->email;
            $chargeId = $charge->id;

            // go to success url with cart item id and stripe session id
            return redirect()->route('stripe.success', ['customer_id' => $customerId, 'payer_email' => $payerEmail, 'charge_id' => $chargeId, 'cart_item' => $cart_item]);
        } catch (\Exception $e) {
            return redirect()->route('stripe.cancel');
        }
    }


    public function success(Request $request)
    {
        $customerId = $request->customer_id;
        $payer_email = $request->payer_email;
        $chargeId = $request->charge_id;

        $sessionId = time() . rand(1000, 9999);

        $cart_item = $request->cart_item;
        $item = Cart::where('id', $cart_item)->first();
        $item->session_id = $sessionId;
        $item->save();

        $user = User::where('id', $item->user_id)->first();
        $fullName = explode(' ', $user->name);
        $firstName = $fullName[0];
        $lastName = isset($fullName[1]) ? $fullName[1] : '';

        $track = MusicTitle::where('id', $item->track_id)->first();

        $payemnt_date = date('Y-m-d H:i:s T');

        $payment = new Payment();
        $payment->payer_email = $payer_email;
        $payment->first_name = $firstName;
        $payment->last_name = $lastName;
        $payment->payer_id = $customerId;
        // file name without extension 
        $fileName = pathinfo($track->file, PATHINFO_FILENAME);
        $payment->file = $fileName;
        $payment->item_name = $track->title . '|' . $track->artist;
        $payment->item_number = $track->id;
        $payment->quantity = 1;
        $payment->amount = $item->price;
        $payment->mc_currency = 'USD';
        $payment->tax = 0;
        $payment->payment_date = $payemnt_date;
        $payment->payment_status = 'Completed';
        $payment->pending_reason = '';
        $payment->receiver_email = 'info@greatomusic.com';
        $payment->address_name = $item->address ? $item->address : '';
        $payment->address_street = $item->address ? $item->address : '';
        $payment->address_city = $user->city ? $user->city : '';
        $payment->address_state = $user->state ? $user->state : '';
        $payment->address_country = $user->country ? $user->country : '';
        $payment->address_zip = '';
        $payment->txn_id = $chargeId;
        $payment->txn_type = 'web_accept';
        $payment->verify_sign = '';
        $payment->auth = '';
        $payment->session_id = $sessionId;
        $payment->date = date('Y-m-d H:i:s');
        $payment->save();

        // Generate a name using the current timestamp
        $pdfName = time();
        // store in license table

        // Generate Random Id
        $randomId = rand(10000, 99999);
        $date1 = date('mdyhis');
        $randomId .= $date1;

        $licenseId = DB::table('license')->insertGetId([
            'random_id' => $randomId,
            'user' => $user->id,
            'company_name' => $item->company_name,
            'legal_name' => $item->legal_name,
            'address' => $item->address,
            'project' => $item->project,
            'license' => $item->license,
            'territory' => $item->territory,
            'term' => $item->term,
            'track_id' => $item->track_id,
            'price' => $item->price,
            'number' => $pdfName,
            'session_id' => $sessionId,
            'date' => date('Y-m-d H:i:s')
        ]);

        $license = DB::table('license')->find($licenseId);

        // update the cart item status 1 to 0
        $cart = Cart::where('id', $cart_item)->first();
        $cart->status = 0;
        $cart->save();

        $price = $cart->price;
        if ($cart->coupon_discount != null) {
            $price = $price - $cart->coupon_discount;
        }

        $data = [
            'name' => $user->name,
            'company_name' => $license->company_name,
            'leagal_name' => $license->legal_name,
            'address' => $license->address,
            'title' => $track->title,
            'license' => $license->license,
            'territory' => $license->territory,
            'term' => $license->term,
            'price' => $price,
            'email' => $user->email,
            'license_id' => $license->id,
            'subject' => 'Great "O" Music | License Details',
        ];
        // Mail::send(new LicenseDetailMail($data));

        $send_mail = ContactUs::first()->send_mail;
        Mail::send(new LicenseDetailMail($data),[$send_mail], function ($m) {
            $m->from($send_mail, 'Great "O" Music');
        });

        // // generate invoice
        // $data = [
        //     'date' => date('Y-m-d'),
        //     'invoiceNumber' => $license->id,
        //     'companyName' => $license->company_name,
        //     'name' => $license->legal_name,
        //     'address' => $license->address,
        //     'project' => $license->project,
        //     'title' => $track->title,
        //     'license' => $license->license,
        //     'territory' => $license->territory,
        //     'term' => $license->term,
        //     'price' => $license->price,
        // ];

        // // Render the view to HTML
        // $html = View::make('pdf.invoice', $data)->render();

        // $dompdf = new Dompdf();
        // $dompdf->loadHtml($html);
        // $dompdf->render();

        // // Save the PDF file
        // $pdf = $dompdf->output();
        // $pdfPath = public_path('pdf/invoice/' . $pdfName . '.pdf');
        // file_put_contents($pdfPath, $pdf);

        // // aggrement pdf generate
        // $aggrementData = [
        //     'to' => $payment->first_name . ' ' . $payment->last_name,
        //     'address' => $item->address,
        //     'date' => date('Y-m-d'),
        //     're' => $track->title . ',' . $track->artist,
        //     'license' => $cart->license,
        //     'project' => $cart->project,
        //     'title' => $track->title,
        //     'term' => $cart->term,
        //     'territory' => $cart->territory,
        //     'price' => $cart->price,
        // ];

        // // Render the view to HTML
        // $html = View::make('pdf.agreement', $aggrementData)->render();

        // $dompdf = new Dompdf();
        // $dompdf->loadHtml($html);
        // $dompdf->render();

        // // Save the PDF file
        // $pdf = $dompdf->output();
        // $pdfPath = public_path('pdf/agreement/' . $pdfName . '.pdf');
        // file_put_contents($pdfPath, $pdf);

        // return redirect to account page with success-toast
        return redirect()->route('frontend.account')->with('success-toast', 'Payment successfully completed.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('frontend.account')->with('error-toast', 'Payment failed, please try again.');
    }
}
