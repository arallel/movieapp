<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\ActorsViewModels;
use App\ViewModels\ActorViewModel;


class Actorcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500,204);

        $popularActors = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/popular?page='.$page)
        ->json()['results']; 

        $viewModel = new ActorsViewModels(
            $popularActors,
            $page,
        );

        return view('actors.index',$viewModel);
    }
    public function show($id)
    {
         $actor = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id)
        ->json(); 
        $social = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')
        ->json(); 
        $credits = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
        ->json(); 


        $viewModel = new ActorViewModel($actor,$social,$credits);


        return view('actors.show',$viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuimnate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
