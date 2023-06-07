<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieService
{

    public function showMovies(Request $request)
    {
        $title = $request->input('title');

        if ($title) {
            $movies = Movie::search($title);
        } else {
            $movies = Movie::paginate(10);
        }

        return $movies;
    }

    public function postMovie(Request  $request)
    {

        $request->validate([
            'title' => 'required|unique:movies,title',
            'director' => 'required',
            'image_url' => 'url',
            'duration' => 'required|between:1,500',
            'release_date' => 'required|unique:movies,release_date',
            'genre' => 'required'
        ]);

        $movie = new Movie();

        $movie->title = $request->title;
        $movie->director = $request->director;
        $movie->image_url = $request->image_url;
        $movie->duration = $request->duration;
        $movie->release_date = $request->release_date;
        $movie->genre = $request->genre;
        $movie->save();

        return $movie;
    }

    public function showMovie($id)
    {

        $movie = Movie::find($id);
        return $movie;
    }

    public function editMovie(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:movies,title',
            'director' => 'required',
            'image_url' => 'url',
            'duration' => 'required|between:1,500',
            'release_date' => 'required|unique:movies,release_date',
            'genre' => 'required'
        ]);

        $movie = Movie::find($id);
        $movie->title = $request->title;
        $movie->director = $request->director;
        $movie->image_url = $request->image_url;
        $movie->duration = $request->duration;
        $movie->release_date = $request->release_date;
        $movie->genre = $request->genre;
        $movie->save();

        return $movie;
    }

    public function deleteMovie($id)
    {

        Movie::destroy($id);
    }
}
