<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Tempo;
use App\Models\Version;
use App\Models\MusicTitle;
use Illuminate\Support\Facades\Validator;

class MusicTitleController extends Controller
{
    public function index()
    {
        $music_titles = MusicTitle::all();
        // $music_titles = MusicTitle::where('id',1441)->first();

        $pageTitle = 'Manage Music Titles';
        return view('admin.music_titles.index', compact('music_titles', 'pageTitle'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $music_titles = MusicTitle::where('title','like', '%' . $search . '%')
        ->orderBy('id')
        ->paginate(10);
        $pageTitle = 'Manage Music Titles';
        return view('admin.music_titles.index', compact('music_titles', 'pageTitle','search'));
    }

    public function create()
    {
        $pageTitle='Add Music Title';
        $artists = Artist::orderBy('name')->get();
        $genres = Genre::all();
        $tempos = Tempo::all();
        $versions = Version::all();
        return view('admin.music_titles.create', compact('pageTitle', 'artists', 'genres', 'tempos', 'versions'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file' => 'required|mimes:mp3',
            'file1' => 'required|mimes:wav',
        ],[
            'title.required' => 'Title field is required!',
            'file.required' => 'Mp3 file is required!',
            'file.mimes' => '.mp3 files allowed only',
            'file1.required' => 'Wav file is required!',
            'file1.mimes' => '.wav files allowed only!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mp3_file = $request->file('file');
        $mp3_file_name = $mp3_file->getClientOriginalName();
        $mp3_file->move(public_path('admin-assets/audio'), $mp3_file_name);

        $wav_file = $request->file('file1');
        $wav_file_name = $wav_file->getClientOriginalName();
        $wav_file->move(public_path('admin-assets/audio'), $wav_file_name);
        $music_titles = new MusicTitle();
        $music_titles->title = $request['title'];
        $music_titles->artist = $request['artist'];
        $first_genre_name = $request['first_genre_name'] ? $request['first_genre_name'] : '';
        $second_genre_name = $request['second_genre_name'] ? ', '.$request['second_genre_name'] : '';
        $third_genre_name = $request['third_genre_name'] ? ', '.$request['third_genre_name'] : '';
        
        $music_titles->genre = $first_genre_name.$second_genre_name.$third_genre_name;
        $music_titles->tempo = $request['tempo'];
        $music_titles->version = $request['version'];
        $music_titles->file = $mp3_file_name;
        $music_titles->file1 = $wav_file_name;
        $music_titles->date = date('Y-m-d H:i:s');
        $music_titles->save();

        return redirect()->route('musictitles')->with('success', 'Music Title added successfully');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Music Title';
        
        $music_titles = MusicTitle::find($id);
        // dd($music_titles);

        $totalGenres = $music_titles->genre;
        $genre_names = explode(',', $totalGenres);

        $artists = Artist::orderBy('name')->get();
        $genres = Genre::all();
        $tempos = Tempo::all();
        $versions = Version::all();
        // dd($genres);
        return view('admin.music_titles.edit', compact('pageTitle', 'music_titles', 'artists', 'genres', 'tempos', 'versions'));
    }

    public function update(Request $request, $id)
    {
        $validator = $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file' => 'mimes:mp3',
            'file1' => 'mimes:wav',
        ],[
            'title.required' => 'Title field is required!',
            'file.mimes' => '.mp3 files allowed only',
            'file1.mimes' => '.wav files allowed only!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $music_titles = MusicTitle::find($id);
        $music_titles->title = $request['title'];
        $music_titles->artist = $request['artist'];

        $first_genre_name = $request['first_genre_name'] ? $request['first_genre_name'] : '';
        $second_genre_name = $request['second_genre_name'] ? ', '.$request['second_genre_name'] : '';
        $third_genre_name = $request['third_genre_name'] ? ', '.$request['third_genre_name'] : '';

        $music_titles->genre = $first_genre_name.$second_genre_name.$third_genre_name;
        // echo $music_titles->genre;die();

        $music_titles->tempo = $request['tempo'];
        $music_titles->version = $request['version'];

        if($request->hasFile('file')){
            $mp3_file = $request->file('file');
            //$mp3_file_name = $mp3_file->getClientOriginalExtension();
            $mp3_file_name = $mp3_file->getClientOriginalName();
            $mp3_file->move(public_path('admin-assets/audio'), $mp3_file_name);
            $music_titles->file = $mp3_file_name;
        }

        if($request->hasFile('file1')){
            $wav_file = $request->file('file1');
            //$wav_file_name = $wav_file->getClientOriginalExtension();
            $wav_file_name = $wav_file->getClientOriginalName();
            $wav_file->move(public_path('admin-assets/audio'), $wav_file_name);
            $music_titles->file1 = $wav_file_name;
        }

        $music_titles->date = date('Y-m-d H:i:s');
        $music_titles->save();

        return redirect()->route('musictitles')->with('success', 'Music Title updated successfully');
    }

    public function delete($id)
    {
        $music_titles = MusicTitle::find($id);
        $music_titles->delete();
        return redirect()->route('musictitles')->with('success', 'Music Title deleted successfully');
    }
}
