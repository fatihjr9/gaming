<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Topup {{ $name }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="absolute inset-0 z-0 md:relative w-full pb-[18rem] md:pb-[36rem]">
        <video class="absolute w-full h-full object-cover" autoplay loop muted playsinline>
          <source src="{{ asset('/mlbb.mp4') }}" type="video/mp4">
        </video>
        <div class="w-full h-full bg-gradient-to-b from-black/10 to-black absolute inset-0"></div>
        <div class="w-full h-full bg-gradient-to-l from-black/10 to-black absolute inset-0"></div>
    </div>  
    <div class="flex flex-col md:flex-row items-start justify-between px-4 md:px-16 z-20 relative gap-6 mt-10 md:-mt-[32rem] mb-10">
        {{-- card --}}
        <div class="flex flex-col space-y-4 w-full md:w-96">
            <div class="bg-gray-900 ring-1 ring-gray-700 w-full rounded-lg h-fit">
                <img class="rounded-lg h-24 object-cover bg-center w-24 mx-auto -mt-6" src="https://images.unsplash.com/photo-1604076913837-52ab5629fba9?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGFic3RyYWN0fGVufDB8fDB8fHww" alt="">
                <div class="flex flex-col p-2.5">
                    <div class="mb-2">
                        <h5 class="text-lg font-semibold text-white truncate">{{ $name }}</h5>
                        <p class="text-base text-gray-500">Proses Top Up {{ $name }} Otomatis Selama 24 Jam</p>
                    </div>
                    <a href="/" class="w-full ring-1 ring-gray-500 text-gray-500 py-2 rounded-lg text-center px-2.5 hover:bg-indigo-600 transition-all hover:ring-indigo-600 hover:text-white">Kembali</a>
                </div>
            </div>
            <div class="hidden md:block bg-gray-900 ring-1 ring-gray-700 w-full md:w-80 rounded-lg h-fit p-2.5">
                <h5 class="text-lg font-semibold text-white">Pembayaran menggunakan</h5>
                <img class="w-24 my-4" src="{{ asset('/Midtrans.svg') }}" alt="">
            </div>
        </div>
        {{-- content --}}
        <form id="pay-form" action="{{ route('place-order') }}" method="POST" class="space-y-4 bg-gray-800 px-6 py-4 rounded-xl ring-1 ring-gray-600 h-fit w-full">
            @csrf
            <section class="space-y-2">
                <h5 class="text-white text-lg font-semibold">Masukkan data</h5>
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
            <h5 class="text-white text-lg font-semibold">Pilih Layanan</h5>
            <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 items-start gap-4 text-sm text-gray-900">
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
</body>
</html>