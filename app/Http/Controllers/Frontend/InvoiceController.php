<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\Canvas;
use Illuminate\Support\Facades\View;
use App\Models\MusicTitle;
use App\Models\Payment;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function invoice($randomId)
    {
        if (!Auth::check() && !Auth::guard('admin')->check()) {
            return redirect('/login');
        }

        $license = DB::table('license')->where('random_id', $randomId)->first();

        if(!$license) {
            return redirect('/404');
        }

        if(Auth::guard('admin')->check()) {
            $pageTitle = 'Great “O” Music - Invoice';
            return view('frontend.invoice', compact('license', 'pageTitle'));
        } else {
            if(Auth::user()->id == $license->user) {
                $pageTitle = 'Great “O” Music - Invoice';
                return view('frontend.invoice', compact('license', 'pageTitle'));
            } else {
                return redirect('/404');
            }
        }
    }

    public function downloadInvoice($randomId)
    {
        if (!Auth::check() && !Auth::guard('admin')->check()) {
            return redirect('/login');
        }
        
        // Retrieve the license details
        $license = DB::table('license')->where('random_id', $randomId)->first();
        // $license = DB::table('license')->where('id', $licenseId)->first();
        $track = MusicTitle::where('id', $license->track_id)->first();
        $cart = Cart::where('session_id', $license->session_id)->first();

        if($cart) {
            $price = $cart->price;
            if ($cart->coupon_discount != null) {
                $price = $price - $cart->coupon_discount;
            }
        } else {
            $price = $license->price;
        }

        // Load the invoice view
        $data = [
            'date' => $license->date,
            'invoiceNumber' => $license->id,
            'companyName' => $license->company_name,
            'name' => $license->legal_name,
            'address' => $license->address,
            'project' => $license->project,
            'title' => $track->title,
            'license' => $license->license,
            'territory' => $license->territory,
            'term' => $license->term,
            'price' => $price,
        ];

        $view = View::make('pdf.invoice', $data);

        // Generate the PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
        $options->set('isRemoteEnabled', true); // Enable remote file access
        $options->set('isPhpEnabled', true); // Enable inline PHP code

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view->render());
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML
        $dompdf->render();

        // Add page number to each page
        $totalPages = $dompdf->getCanvas()->get_page_number();
        $font = $dompdf->getFontMetrics()->get_font('Times-Roman', 'normal');
        for ($i = 1; $i <= $totalPages; $i++) {
            $canvas = $dompdf->getCanvas();
            $canvas->page_text(297, 820, 'Page ' . $i . '/' . $totalPages, $font, 10, [0, 0, 0], 0.5, null, 'C');
        }

        // Download the PDF
        // $random = rand(10000, 99999);
        // $date1 = date('mdyhis');
        // $random .= $date1;
        $filename = $license->random_id . '.pdf';
        return $dompdf->stream($filename);

    }

    public function agreement($randomId)
    {
        if (!Auth::check() && !Auth::guard('admin')->check()) {
            return redirect('/login');
        }

        $license = DB::table('license')->where('random_id', $randomId)->first();
        // $license = DB::table('license')->where('id', $id)->first();
        if(!$license) {
            return redirect('/404');
        }
        $track = MusicTitle::where('id', $license->track_id)->first();
        $payment = Payment::where('session_id', $license->session_id)->first();
        $cart = Cart::where('session_id', $license->session_id)->first();

        if(Auth::guard('admin')->check()) {
            $pageTitle = 'Great “O” Music - Agreement';
            return view('frontend.agreement', compact('license', 'track', 'payment', 'cart', 'pageTitle'));
        } else {
            if(Auth::user()->id == $license->user) {
                $pageTitle = 'Great “O” Music - Agreement';
                return view('frontend.agreement', compact('license', 'track', 'payment', 'cart', 'pageTitle'));
            } else {
                return redirect('/404');
            }
        }
    }

    public function downloadAgreement($randomId)
    {
        if (!Auth::check() && !Auth::guard('admin')->check()) {
            return redirect('/login');
        }

        // Retrieve the license details
        $license = DB::table('license')->where('random_id', $randomId)->first();
        // $license = DB::table('license')->where('id', $licenseId)->first();
        $track = MusicTitle::where('id', $license->track_id)->first();
        $payment = Payment::where('session_id', $license->session_id)->first();
        $cart = Cart::where('session_id', $license->session_id)->first();

        if($cart) {
            $price = $cart->price;
            if ($cart->coupon_discount != null) {
                $price = $price - $cart->coupon_discount;
            }
        } else {
            $price = $license->price;
        }

        // Load the agreement view
        $data = [
            'to' => $license->legal_name,
            'company_name' => $license->company_name,
            'address' => $license->address,
            'date' => $license->date,
            're' => 'Non-Exclusive License: "'. $track->title . '", ' . $track->artist,
            'license' => $license->license,
            'project' => $license->project,
            'title' => $track->title,
            'term' => $license->term,
            'territory' => $license->territory,
            'price' => $price,
        ];
        $view = View::make('pdf.agreement', $data);

        // Generate the PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
        $options->set('isRemoteEnabled', true); // Enable remote file access
        $options->set('isPhpEnabled', true); // Enable inline PHP code

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view->render());
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML
        $dompdf->render();

        // Add page number to each page
        $totalPages = $dompdf->getCanvas()->get_page_number();

        $font = $dompdf->getFontMetrics()->get_font('Times-Roman', 'normal');
        for ($i = 1; $i <= $totalPages; $i++) {
            $canvas = $dompdf->getCanvas();
            $canvas->line(20, 805, 580, 805, array(0, 0, 0), 1);
            $canvas->page_text(530, 810, $i . ' / ' . $totalPages, $font, 13, [0, 0, 0], 0.5, null, 'R');
        }

        // Download the PDF
        // $random = rand(10000, 99999);
        // $date1 = date('mdyhis');
        // $random .= $date1;
        $filename = $license->random_id . '.pdf';
        return $dompdf->stream($filename);
    }
}
