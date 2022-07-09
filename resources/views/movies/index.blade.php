@extends('layouts.main')
@section('isi')
<div class="container mx-auto px-4 pt-16">
	<div class="popular-movies">
		<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
		<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3
		 lg:grid-cols-4 gap-8">
		    @foreach($popularMovies as $movie)
		    <x-moviecard :movie="$movie" />
			@endforeach
		</div>
	</div> <!-- end popular movie -->
	<div class="now-playing-movies py-24">
		<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
		<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3
		 lg:grid-cols-4 gap-8">
			@foreach($Nowplaying as $movie)
			 <x-moviecard :movie="$movie" />
			@endforeach
		</div>
	</div>
</div>
@endsection