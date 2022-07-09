<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;


class filmViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
          'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('d M Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'cast' => collect($this->movie['credits']['cast'])->take(5),
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'images' => collect($this->movie['images']['backdrops'])->take(12),
        ])->only(['poster_path','id','title','vote_average','overview','release_date','genres','credits','videos','images','crew','cast']);
    }
}
