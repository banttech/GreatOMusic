<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\MusicTitle;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Tempo;
use App\Models\Version;
use App\Models\PagesHome;
use App\Models\Faq;
use App\Models\PagesAbout;
use App\Models\PagesLicensing;
use App\Models\PagesContact;
use App\Models\PagesTerms;
use App\Models\Contact;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\State;
use App\Models\Country;
use App\Models\ContactUs;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\ContactAdminMail;
use App\Mail\LicenseDetailMail;

class FrontendController extends Controller
{
    public function test()
    {
        $body = "<h2>hello world</h2>";
        // echo $body;die();
        $headers = "From: tanmay@banttech.com\r\n";
        $headers .= "Reply-To: tanmay@banttech.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
        $send_mail = 'aa2288485@gmail.com';
        if(!mail($send_mail, 'Great "O" Music | Website Email', $body, $headers)){
            print_r(error_get_last());
            echo "mail not send";
        }else{
            echo "mail sent";
        }
        die();

        $data = [
            'name' => 'Ammar',
            'company_name' => 'Banttech',
            'leagal_name' => 'Banttech',
            'address' => 'Lahore',
            'title' => 'Test Title',
            'license' => 'Test License',
            'territory' => 'Test Territory',
            'term' => 'Test Term',
            'price' => 100,
            'email' => 'ammar.banttech@gmail.com',
            'subject' => 'Great "O" Music | License Details',
            'license_id' => 1,
            'from' => 'abcd'
        ];
        // send welcome email to user
        // Mail::send(new LicenseDetailMail($data));
        $user = ContactUs::first()->send_mail;
        // Mail::send(new LicenseDetailMail($data),[$send_mail], function ($m) {
        //     $m->from('info@ammar.com', 'ABC');
        // });

        Mail::send('emails.license-detail', ['data' => $data], function ($m) use ($user) {
            $m->from('info@greatomusic.com', 'Great "O" Music');
            $m->to('tanmay.banttech@aol.com', 'Ammar')->subject('Your Reminder!');
 
            // $m->to($user->email, $user->name)->subject('Your Reminder!');
        });

        dd('Mail Send Successfully');
    }
    public function index(Request $request)
    {
        if ($request->search) {
            $search = $request->search;
            $musicTitles = MusicTitle::where('title', 'like', '%' . $search . '%')
                ->orWhere('artist', 'like', '%' . $search . '%')
                ->orWhere('genre', 'like', '%' . $search . '%')
                ->orWhere('tempo', 'like', '%' . $search . '%')
                ->orWhere('version', 'like', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate(6);
        } else {
            $musicTitles = MusicTitle::orderBy('id', 'desc')->paginate(6);
        }
   

        $sliders = Slider::all();
        $artists = Artist::orderBy('id', 'desc')->limit(30)->get();
        $genres = Genre::orderBy('id', 'desc')->limit(30)->get();
        $homeContent = PagesHome::first();
        $faqs = Faq::all();
        $pageTitle = "Great “O” Music - Home";
        // dd($genres);

        // Mail::raw('Hello World', function ($message) {
        //     $message->to('ammar.banttech@gmail.com')
        //         ->subject('Hello World');
        // });

        return view('frontend.index', compact('sliders', 'musicTitles', 'artists', 'genres', 'homeContent', 'faqs', 'pageTitle'));
    }

    public function searchMusic(Request $request)
    {
        // this is ajax request

        $musics = MusicTitle::query();

        if ($request->search) {
            $searchTerm = $request->search;
            $musics->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('artist', 'like', '%' . $searchTerm . '%')
                    ->orWhere('genre', 'like', '%' . $searchTerm . '%')
                    ->orWhere('tempo', 'like', '%' . $searchTerm . '%')
                    ->orWhere('version', 'like', '%' . $searchTerm . '%');
            });
        }

        $musics = $musics->orderBy('id', 'desc')->get();
        // send status code 200 and response
        return response()->json([
            'data' => $musics,
        ], 200);
    }

    public function about()
    {
        $pageTitle = "Great “O” Music - About";
        $aboutContent = PagesAbout::first();
        return view('frontend.about', compact('pageTitle', 'aboutContent'));
    }

    public function musicSearch(Request $request)
    {
        // if request has post method
        $musics = MusicTitle::query();


        // check if query string has q then filter by q

        $q = $request->query('q');
    
        if ($q && $q != '') {
            $musics->where(function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%')
                    ->orWhere('artist','like', '%' . $q . '%')
                    ->orWhere('genre', 'like', '%' . $q . '%')
                    ->orWhere('tempo', 'like', '%' . $q . '%')
                    ->orWhere('version', 'like', '%' . $q . '%');
            });
        }

        $title = $request->query('title');
        if ($title && $title != '') {
            // match with same title using equal operator
            $musics->where('title', '=', $title);
        }

        $artist = $request->query('artist');
        if ($artist && $artist != '') {
          
            // convert artist to array using comma as delimiter and search in array
            // $artistNames = explode(',', $artist);
            // dd($artist);
            $artist_names = array();
            $artist_ids = explode(',', $artist);
            // dd($artist_ids);
            foreach ($artist_ids as $artist_id) {
                $artist_name = Artist::where('id', $artist_id)->pluck('name');
                if (isset($artist_name[0]) && $artist_name[0] != ''){
                    array_push($artist_names, $artist_name[0]);
                }
            }
            // $artist_name =  Artist::where('id', $artist)->pluck('name');
            $musics->whereIn('artist', $artist_names);
        }

        $genre = $request->query('genre');
        if ($genre && $genre != '') {
            // convert genre to array using comma as delimiter and search in array
            $genreNames = explode(',', $genre);
            $musics->whereIn('genre', $genreNames);
        }

        $tempo = $request->query('tempo');
        if ($tempo && $tempo != '') {
            // convert tempo to array using comma as delimiter and search in array
            $tempoNames = explode(',', $tempo);
            $musics->whereIn('tempo', $tempoNames);
        }

        $version = $request->query('version');
        if ($version && $version != '') {
            // convert version to array using comma as delimiter and search in array
            $versionNames = explode(',', $version);
            $musics->whereIn('version', $versionNames);
        }

        $musics = $musics->orderBy('id', 'desc')->paginate(12);
        $pageTitle = "Great “O” Music - Music Search";
        $artists = Artist::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();
        $tempos = Tempo::orderBy('name', 'asc')->get();
        $versions = Version::orderBy('name', 'asc')->get();
        return view('frontend.music-search', compact('pageTitle', 'musics', 'artists', 'genres', 'tempos', 'versions'));
    }

    public function licensing()
    {
        $pageTitle = "Great “O” Music - Licensing";
        $licenseContent = PagesLicensing::first();
        return view('frontend.licensing', compact('pageTitle', 'licenseContent'));
    }

    public function contact()
    {
        $pageTitle = "Great “O” Music - Contact";
        $contactContent = PagesContact::first();
        return view('frontend.contact', compact('pageTitle', 'contactContent'));
    }

    public function terms()
    {
        $pageTitle = "Great “O” Music - Terms";
        $termsContent = PagesTerms::first();
        return view('frontend.terms', compact('pageTitle', 'termsContent'));
    }

    public function storeInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'reason' => 'required',
            'comments' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'reason.required' => 'Question is required',
            'comments.required' => 'Message is required',
        ]);

        // dd($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contact = new Contact();
        $contact->name = $request->name ? $request->name : '';
        $contact->email = $request->email ? $request->email : '';
        $contact->reason = $request->reason ? $request->reason : '';
        $contact->comments = $request->comments? $request->comments : '';
        $contact->date = date('Y-m-d H:i:s');
        $contact->save();

        // send contact email to user
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'reason' => $request->reason,
            'subject' => 'Great "O" Music | Website Email',
            'comments' => $request->comments,
        ];
        // Mail::send(new ContactMail($data));

        $send_mail = ContactUs::first()->send_mail;
        // $send_mail = 'aa2288485@gmail.com';
        Mail::send(new ContactMail($data),[$send_mail], function ($m) {
            $m->from($send_mail, 'Great "O" Music');
        });
        // Mail::send('emails.template1', ['data' => $data], function ($m) use ($send_mail,$data) {
        //     $m->to($data['email'],$data['name'])->subject('Great "O" Music | Website Email');
        //     $m->from($send_mail, 'Great "O" Music');
        // });
        // Mail::send('emails.template2', ['data' => $data], function ($m) use ($send_mail,$data) {
        //     $m->to($data['email'],$data['name'])->subject('Great "O" Music | Website Email');
        //     $m->from($send_mail, 'Great "O" Music');
        // });

        /*Mail::send('emails.template3', ['data' => $data], function ($m) use ($send_mail,$data) {
            $m->to($data['email'],$data['name'])->subject('Great "O" Music | Website Email');
            $m->from($send_mail, 'Great "O" Music');
        });*/



        $contactUs = ContactUs::first();
        $data = [
            'name' => $request->name,
            'email' => $contactUs->receive_mail,
            'reason' => $request->reason,
            'comments' => $request->comments,
            'user_email' => $request->email,
            'subject' => 'Great "O" Music | Website Email',
        ];
        // Mail::send(new ContactAdminMail($data1));


        $data1 = [
            'name' => $request->name,
            'email' => $contactUs->receive_mail,
            'reason' => $request->reason,
            'comments' => $request->comments,
            'user_email' => $request->email,
            'subject' => 'Great "O" Music | Website Email',
        ];
        $send_mail = ContactUs::first()->send_mail;

        Mail::send(new ContactAdminMail($data1),[$send_mail], function ($m) {
            $m->from($send_mail, 'Great "O" Music');
        });

        // Mail::send('emails.template1', ['data' => $data1], function ($m) use ($send_mail) {
        //     $m->to($contactUs->receive_mail, 'Great "O" Music')->subject('Your Reminder!');
        //     $m->from($send_mail, 'Great "O" Music');
        // });
        // Mail::send('emails.template2', ['data' => $data1], function ($m) use ($send_mail) {
        //     $m->from($send_mail, 'Great "O" Music');
        // });


        $body = view('emails.contact-admin', compact('data'));
        // echo $body;die();
        $headers = "From: ".$request->email."\r\n";
        $headers .= "Reply-To: ".$request->email."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
        $send_mail = 'aa2288485@gmail.com';
        mail($send_mail, 'Great "O" Music | Website Email', $body, $headers);

        return redirect()->back()->with('success', 'Your message has been successfully sent. We will contact you soon!');
    }

    public function account()
    {
        $pageTitle = "Great “O” Music - Account";
        $user = Auth::user();
        $licenses = DB::table('license')->where('user', $user->id)->orderBy('id', 'desc')->paginate(10);
        // loop thourgh licenses and get music title
        foreach ($licenses as $license) {
            $license->music_title = MusicTitle::find($license->track_id);
        }
        // add cart items to licenses
        foreach ($licenses as $license) {
            $license->cart = Cart::where('session_id', $license->session_id)->first();
        }

        return view('frontend.account', compact('pageTitle', 'user', 'licenses'));
    }

    public function editAccount()
    {
        $pageTitle = "Great “O” Music - Edit Account";
        $user = Auth::user();
        $states = State::orderBy('name', 'asc')->get();
        $countries = Country::orderBy('name', 'asc')->get();
        return view('frontend.edit-account', compact('pageTitle', 'user', 'states', 'countries'));
    }

    public function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company' => 'required',
            'position' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'website' => 'required',
            'here_about_us' => 'required',
        ], [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'phone.required' => 'Phone Number field is required',
            'company.required' => 'Company Name field is required',
            'position.required' => 'Position field is required',
            'city.required' => 'City field is required',
            'state.required' => 'State field is required',
            'country.required' => 'Country field is required',
            'website.required' => 'Website field is required',
            'here_about_us.required' => 'HOW did you hear about us? is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->company = $request->company;
        $user->position = $request->position;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->website = $request->website;
        $user->referred_by = $request->here_about_us;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->save();

        return redirect()->back()->with('success', 'Congratulations. Your account has been updated successfully.');
    }
}
