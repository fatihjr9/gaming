@extends('layout.layout')

@section('content')
<style>
    .selected-game {
        @apply ring-1 ring-indigo-600
    }
</style>
<div class="bg-gray-900 mt-60 md:my-10 w-11/12 mx-auto rounded-xl ring-1 ring-gray-600">
    <div class="space-y-4 p-2">
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
            <div class="flex flex-col space-y-2">
                <h5 class="text-lg text-white">Pilih Layanan</h5>
                <div class="w-10 overflow-x-auto flex flex-row gap-2 pb-2">
                    @if($data && isset($data['data']) && count($data['data']) > 0)
                        @php
                            $uniqueGames = collect($data['data'])->where('status', 'available')->unique('game');
                        @endphp

                        @foreach($uniqueGames as $game)
                            <a href="#" class="text-white game-link whitespace-nowrap px-4 py-2 bg-gray-700 hover:bg-gray-900 rounded-md" data-game="{{ $game['game'] }}">{{ $game['game'] }}</a>
                        @endforeach
                    @else
                        <p>No data available</p>
                    @endif
                </div>
            </div>
            <section class="grid grid-cols-2 md:grid-cols-4 items-start gap-4 text-sm text-gray-900">
                @if($data && isset($data['data']) && count($data['data']) > 0)
                    @foreach($data['data'] as $feature)
                        @if($feature['status'] === "available")
                            <div class="px-4 py-2 w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 game-container" data-game="{{ $feature['game'] }}">
                                <div class="flex flex-col space-y-2">
                                    <div class="flex flex-row items-start justify-between">
                                        <div class="flex flex-col">
                                            <label class="w-40 text-lg font-medium text-gray-900 dark:text-white truncate">{{ $feature['game'] }}</label>
                                            <label class="w-40 text-lg font-normal text-gray-900 dark:text-gray-500 truncate">{{ $feature['name'] }}</label>
                                        </div>
                                        <input type="radio" id="{{ $feature['code'] }}" name="selectedCategory" value="{{ $feature['code'] }}, {{ $feature['price']['basic'] }}" class="w-4 h-4 border border-gray-300 rounded-lg p-2 mt-2 focus:outline-none focus:border-indigo-600 focus:ring focus:ring-indigo-600"/>
                                    </div>
                                    <label class="w-full text-lg font-semibold text-gray-900 dark:text-white">Rp {{ number_format($feature['price']['basic'], 0, ',', '.') }}</label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>No data available</p>
                @endif
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hide all game containers initially
        const gameContainers = document.querySelectorAll('.game-container');
        gameContainers.forEach(container => {
            container.style.display = 'none';
        });

        // Add click event listener to game links
        const gameLinks = document.querySelectorAll('.game-link');
        gameLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const selectedGame = this.dataset.game;

                // Hide all game containers
                gameContainers.forEach(container => {
                    container.style.display = 'none';
                });

                // Show the containers for the selected game
                const selectedGameContainers = document.querySelectorAll(`.game-container[data-game="${selectedGame}"]`);
                selectedGameContainers.forEach(container => {
                    container.style.display = 'block';
                });
            });
        });

        var radioButtons = document.querySelectorAll('input[name="selectedCategory"]');
        radioButtons.forEach(function (radio) {
            radio.addEventListener("change", function () {
                var gameContainer = this.closest('.game-container');

                // Hapus kelas 'selected-game' dari semua div
                document.querySelectorAll('.game-container').forEach(function (container) {
                    container.classList.remove('selected-game');
                });

                // Tambahkan kelas 'selected-game' pada div yang dipilih
                gameContainer.classList.add('selected-game');
            });
        });
    });
</script> 
@endsection