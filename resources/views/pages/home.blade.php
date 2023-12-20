@extends('layout.layout')

@section('content')
<div class="px-4 md:px-16 mb-8 mt-60 md:mt-0">
    <h5 class="text-2xl font-bold text-white mb-8">Layanan Yang tersedia</h5>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
        @if($data && isset($data['data']) && count($data['data']) > 0)
            @php
                $uniqueGames = collect($data['data'])->where('status', 'available')->unique('game');
            @endphp

            @foreach($uniqueGames as $game)
                <div class="bg-gray-900 ring-1 ring-gray-700 w-full rounded-lg h-fit my-6">
                    <img class="rounded-lg h-24 object-cover bg-center w-24 mx-auto -mt-6" src="https://images.unsplash.com/photo-1604076913837-52ab5629fba9?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGFic3RyYWN0fGVufDB8fDB8fHww" alt="">
                    <div class="p-2.5 w-full mb-2 flex flex-col">
                        <h5 class="mb-2 text-lg text-white truncate text-center">{{ $game['game'] }}</h5>
                        <a href="{{ route('game-detail', ['name' => $game['game']]) }}" class="text-white px-4 py-2 bg-gray-800 hover:bg-indigo-600 rounded-md w-full text-center">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
        @else
            <p>No data available</p>
        @endif
    </div>
</div>
@endsection