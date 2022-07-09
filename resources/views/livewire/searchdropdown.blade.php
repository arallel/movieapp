<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search (Press '/' to focus)"
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
  <div class="absolute top-2">
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current w-4 text-gray-500  ml-2"><path d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"/></svg>
  </div>
  <div wire:loading>
    <svg role="status" class="spinner inline top-0 right-0  w-6 h-8 mr-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-800" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
    </svg>
</div>
  <div
   class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
   x-show.transition.opacity="isOpen"
   >
   @if (strlen($search) > 2)
    @forelse ($searchresult as $result) 
     <ul>
        <li class="border-b border-gray-700">
           <a href="{{route('show',$result['id'])}}" class="block hover:bg-gray-700 px-3 py-3 flex items-center" @if ($loop->last) @keydown.tab="isOpen = false" @endif>
            @if ($result['poster_path'])
            <img src="{{'https://image.tmdb.org/t/p/w92/'.$result['poster_path']}}" class="w-15">
            @else 
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsHGSEW4I55NoetYnvXU5yimiz_EcJ_muQVA&usqp=CAU" style="height: 137.988px; width: 91.9922px;">
            @endif
            <span class="ml-4">{{$result['title']}}</span>
           </a>
        </li>
      @empty
      <div class="px-3 py-3">
         No Result Found
      </div>  
      @endforelse
     @endif 
     </ul>
  </div>
</div>