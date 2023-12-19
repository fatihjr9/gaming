@extends('layout.layout')
@section('content')
    <div class="flex flex-col px-4 md:px-16 mb-8 mt-60 md:mt-0">
        <h5>{{ $name }}</h5>
        <form id="pay-form" action="{{ route('place-order') }}" method="POST" class="space-y-4 bg-gray-800 px-6 py-4 rounded-xl ring-1 ring-gray-600">
            @csrf
            <section class="space-y-2">
                <h5 class="text-white text-lg">Masukkan data</h5>
                <!-- Input -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="flex w-full">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-indigo-600 border rounded-e-0 border-indigo-600 rounded-s-md">
                          <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                          </svg>
                        </span>
                        <input type="number" name="idUser" placeholder="Masukkan ID"  class="rounded-tr-md rounded-br-md p-2 bg-gray-900 text-white border border-indigo-600 w-full">
                    </div>
                    <input type="number" name="zone" placeholder="Masukkan Zone" class="p-2 bg-gray-900 text-white border  border-indigo-600 rounded-md">
                </div>
            </section>
            <section class="grid grid-cols-2 md:grid-cols-4 items-start gap-4 text-sm text-gray-900">
                @foreach ($matchingGames as $game)
                    @if($game['status'] === "available")
                        <div class="px-4 py-2 w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 game-container" data-game="{{ $game['game'] }}">
                            <div class="flex flex-col space-y-2">
                                <div class="flex flex-row items-start justify-between">
                                    <div class="flex flex-col">
                                        <label class="w-40 text-lg font-medium text-gray-900 dark:text-white truncate">{{ $game['game'] }}</label>
                                        <label class="w-40 text-lg font-normal text-gray-900 dark:text-gray-500 truncate">{{ $game['name'] }}</label>
                                    </div>
                                    <input type="radio" id="{{ $game['code'] }}" name="selectedCategory" value="{{ $game['code'] }}, {{ $game['price']['basic'] }}" class="w-4 h-4 border border-gray-300 rounded-lg p-2 mt-2 focus:outline-none focus:border-indigo-600 focus:ring focus:ring-indigo-600"/>
                                </div>
                                <label class="w-full text-lg font-semibold text-gray-900 dark:text-white">Rp {{ number_format($game['price']['basic'], 0, ',', '.') }}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </section>
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="pay-button" class="bg-indigo-600 w-full h-fit py-2 text-white rounded-md mt-8" type="button">
                Bayar sekarang
            </button>
            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto bg-black/75 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative rounded-lg shadow bg-gray-900 border border-gray-600">
                        <div class="p-4 md:p-5 text-center">
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400 capitalize">apakah data yang anda isi sudah sesuai?</h3>
                            <div class="flex flex-col gap-y-2">
                                <button data-modal-hide="popup-modal" id="confirm-button" class="bg-indigo-600 w-full py-2.5 text-white rounded-md">
                                    kirim sekarang
                                </button>
                                <button data-modal-hide="popup-modal" type="button" class="w-full py-2 bg-gray-800 rounded-md text-white">Batalkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all game containers
            var gameContainers = document.querySelectorAll('.game-container');

            // Attach click event to each game container
            gameContainers.forEach(function (container) {
                container.addEventListener('click', function () {
                    // Get the game name from the data-game attribute
                    var selectedGame = container.getAttribute('data-game');

                    // Set the value of the hidden input
                    document.getElementById('selectedGame').value = selectedGame;
                });
            });
        });
    </script>
@endsection