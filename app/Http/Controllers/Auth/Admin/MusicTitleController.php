<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Tempo;
use App\Models\Version;
use App\Models\MusicTitle;

class MusicTitleController extends Controller
{
    public function index()
    {
        $music_titles = MusicTitle::paginate(10);
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
        $artists = Artist::all();
        $genres = Genre::all();
        $tempos = Tempo::all();
        $versions = Version::all();
        return view('admin.music_titles.create', compact('pageTitle', 'artists', 'genres', 'tempos', 'versions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'mp3' => 'required|mimes:mp3',
            'wav' => 'required|mimes:wav',

        ],[
            'title.required' => 'Title field is required!',
            'mp3.mimes' => '.mp3 files allowed only',
            'mp3.required' => 'MP3 Image field is required!',
            'wav.required' => 'WAV Image field is required!',
            'wav.mimes' => '.wav files allowed only!',
        ]);
        $mp3_file = $request->file('mp3');
        $mp3_file_name = time().'_gom.'.$mp3_file->getClientOriginalExtension();
        $mp3_file->move(public_path('admin-assets/audio'), $mp3_file_name);

        $wav_file = $request->file('wav');
        $wav_file_name = time().'_gom.'.$wav_file->getClientOriginalExtension();
        $wav_file->move(public_path('admin-assets/audio'), $wav_file_name);

        $music_titles = new MusicTitle();
        $music_titles->title = $request['title'];
        $music_titles->artist_id = $request['artist_id'];
        $music_titles->first_genre_id = $request['first_genre_id'];
        $music_titles->second_genre_id = $request['second_genre_id'];
        $music_titles->third_genre_id = $request['third_genre_id'];
        $music_titles->tempo_id = $request['tempo_id'];
        $music_titles->version_id = $request['version_id'];
        $music_titles->mp3 = $mp3_file_name;
        $music_titles->wav = $wav_file_name;
        $music_titles->save();

        return redirect()->route('musictitles')->with('success', 'Music Title added successfully');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Music Title';
        $music_titles = MusicTitle::find($id);
        $artists = Artist::all();
        $genres = Genre::all();
        $tempos = Tempo::all();
        $versions = Version::all();
        return view('admin.music_titles.edit', compact('pageTitle', 'music_titles', 'artists', 'genres', 'tempos', 'versions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'mp3' => 'mimes:mp3',
            'wav' => 'mimes:wav',
        ], [
            'title.required' => 'Title field is required',
            'mp3.mimes' => '.mp3 files allowed only',
            'wav.mimes' => '.wav files allowed only',
        ]);

        $music_titles = MusicTitle::find($id);
        $music_titles->title = $request['title'];
        $music_titles->artist_id = $request['artist_id'];
        $music_titles->first_genre_id = $request['first_genre_id'];
        $music_titles->second_genre_id = $request['second_genre_id'];
        $music_titles->third_genre_id = $request['third_genre_id'];
        $music_titles->tempo_id = $request['tempo_id'];
        $music_titles->version_id = $request['version_id'];

        if($request->hasFile('mp3')){
            $mp3_file = $request->file('mp3');
            $mp3_file_name = time().'_gom.'.$mp3_file->getClientOriginalExtension();
            $mp3_file->move(public_path('admin-assets/audio'), $mp3_file_name);
            $music_titles->mp3 = $mp3_file_name;
        }

        if($request->hasFile('wav')){
            $wav_file = $request->file('wav');
            $wav_file_name = time().'_gom.'.$wav_file->getClientOriginalExtension();
            $wav_file->move(public_path('admin-assets/audio'), $wav_file_name);
            $music_titles->wav = $wav_file_name;
        }

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
