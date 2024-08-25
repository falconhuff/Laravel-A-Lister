<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{
    public function uploadPage(Request $request){
        if($request->has('locale')){
            $locale = $request->get('locale');

            if(in_array($locale, ['en', 'id'])){
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }

        return view('upload');
    }

    public function upload(Request $request){
        $checker = $request->validate([
            'file' => 'required|image',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        $movie = new Movie();
        $movie->title = $checker['title'];
        $movie->path = $path;
        $movie->description = $checker['description'];
        $movie->client_id = auth()->user()->id;
        $movie->save();

        return redirect(route('index'))->with('success', 'Review uploaded successfully.');
    }

    public function update(Request $request, $id){
        $checker = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|image',
        ]);

        $movie = Movie::findOrFail($id);

        if($request->hasFile('file')){
            Storage::disk('public')->delete($movie->path);
            $path = $request->file('file')->store('uploads', 'public');
            $movie->path = $path;
        }

        $movie->title = $checker['title'] ?? $movie->title;
        $movie->description = $checker['description'] ?? $movie->description;
        $movie->edited_by = auth()->user()->id;
        $movie->save();

        return redirect(route('index'))->with('success', 'Review updated successfully.');
    }

    public function editPage(Request $request, $id){
        if($request->has('locale')){
            $locale = $request->get('locale');

            if(in_array($locale, ['en', 'id'])){
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }

        $movie = Movie::findOrFail($id);
        return view('edit', compact('movie'));
    }

    public function delete($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect(route('index'))->with('success', 'Review deleted successfully.');
    }

    public function list(Request $request){
        if($request->has('locale')){
            $locale = $request->get('locale');

            if(in_array($locale, ['en', 'id'])){
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }

        $movies = Movie::all();
        $movies = Movie::with('client')->orderBy('created_at', 'desc')->get();
        return view('list', compact('movies'));
    }
}
