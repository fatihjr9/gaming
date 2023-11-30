@extends('layout.layout')

@section('content')
    <div class="w-full md:w-10/12 mx-auto px-4 md:px-16 py-8 bg-gray-900 border border-gray-600 mt-60 md:mt-0 rounded-2xl">
        <form id="pay-form" action="{{ route('place-order') }}" method="POST">
            @csrf
           <div class="space-y-4">
                <section class="space-y-2">
                    <h5 class="text-white text-lg">Masukkan data</h5>
                    <!-- Input -->
                    <div class="flex flex-col gap-y-2">
                        <input type="number" name="idUser" placeholder="Masukkan ID" class="p-2 bg-black/50 text-white border border-white rounded-md">
                        <input type="number" name="zone" placeholder="Masukkan Zone" class="p-2 bg-black/50 text-white border border-white rounded-md">
                    </div>
                </section>
                <!-- Pricing -->
                <section class="space-y-2">
                    <h5 class="text-white text-lg">Pilih paket</h5>
                    <div class="h-80 overflow-y-scroll border-2 border-gray-600 rounded-2xl p-2">
                        <div class="grid grid-cols-2 md:grid-cols-3 items-start gap-4 text-sm text-gray-900">
                            @if(($data['data']) > 0)
                                @foreach($data['data'] as $feature)
                                    @if($feature['status'] === "available")
                                        <div class="p-2 w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <div class="flex flex-col">
                                                <div class="flex flex-row items-center gap-x-1">
                                                    <img class="w-3 h-3" src="{{ asset('/diamond.png') }}" alt="">
                                                    <label class="w-full text-lg font-medium text-gray-900 dark:text-gray-300 truncate">{{ $feature['name'] }}</label>
                                                </div>
                                                <label class="w-full text-lg font-medium text-gray-900 dark:text-gray-300">Rp {{ $feature['price']['basic'] }}</label>
                                                <div class="flex flex-row items-center gap-x-2 w-full text-sm font-semibold text-gray-900 dark:text-gray-300 mt-4">
                                                    <input type="radio" id="{{ $feature['code'] }}" name="selectedCategory" value="{{ $feature['code']}}, {{ $feature['price']['basic'] }}" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-indigo-600 focus:ring focus:ring-indigo-600"/>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p>No data available</p>
                            @endif
                        </div> 
                    </div>
                </section>
           </div>
            <!-- button buy -->
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="pay-button" class="bg-indigo-600 w-full h-fit py-2 text-white rounded-2xl mt-8" type="button">
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
  @endsection