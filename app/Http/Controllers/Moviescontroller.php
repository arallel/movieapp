<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MovieViewModel;
use App\ViewModels\filmViewModel;

class Moviescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular')
        ->json()['results']; 

        $Nowplaying = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/now_playing')
        ->json()['results']; 

         $genres= Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres']; 


        // return view('index',[
        //   'popularMovies' => $popularMovies,
        //   'Nowplaying' => $Nowplaying,
        //   'genres' => $genres,
        // ]);
         $viewModel = new MovieViewModel(
            $popularMovies,
            $Nowplaying,
            $genres,
        );

        return view('movies.index',$viewModel);
    }
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
        ->json(); 
        
         $viewModel = new filmViewModel(
            $movie
        );

        return view('movies.show',$viewModel);
    }

}
