<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\Request;

class MoviesController extends Controller
{

    public MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $movies = $this->movieService->showMovies($request);

        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $movie = $this->movieService->postMovie($request);

        return $movie;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = $this->movieService->showMovie($id);

        return $movie;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = $this->movieService->editMovie($request, $id);
        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = $this->movieService->deleteMovie($id);
        return $movie;
    }
}
