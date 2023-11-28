@extends('layout.layout')

@section('content')
    <div class="bg-gray-900 grid grid-cols-1 md:grid-cols-2 ring-1 ring-gray-600 p-4 md:p-8 rounded-xl gap-8 items-center">
        <div>
            <img class="w-full h-full md:block hidden" src="{{ asset('/diamond.gif') }}" alt="">
        </div>
        <form id="pay-form" action="{{ route('place-order') }}" method="POST" class="flex flex-col gap-y-2">
            @csrf
            <!-- Input -->
            <div class="flex flex-col gap-y-2">
                <input type="number" name="idUser" placeholder="Masukkan ID" class="p-2 bg-black/50 text-white border border-white rounded-md">
                <input type="number" name="zone" placeholder="Masukkan Zone" class="p-2 bg-black/50 text-white border border-white rounded-md">
            </div>
            <!-- Pricing -->
            <h5 class="text-white">Pilih paket</h5>
            <section class="h-60 overflow-y-scroll">
              <div class="grid grid-cols-2 items-start gap-2 text-sm text-gray-900">
                  @if(($data['data']) > 0)
                      @foreach($data['data'] as $feature)
                          @if($feature['status'] === "available")
                              <div class="p-2 bg-gray-50 dark:bg-gray-700 w-full border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="flex flex-col">
                                    <div class="flex flex-row items-center gap-x-2 w-full text-sm font-semibold text-gray-900 dark:text-gray-300">
                                        <input type="radio" id="{{ $feature['code'] }}" name="selectedCategory" value="{{ $feature['code']}}, {{ $feature['price']['basic'] }}" class="mr-2">
                                        <label for="{{ $feature['code'] }}"class="truncate">{{ $feature['name'] }}</label>
                                    </div>
                                    <label class="w-full text-sm font-medium text-gray-900 dark:text-gray-300">Rp {{ $feature['price']['basic'] }}</label>
                                </div>
                            </div>
                          @endif
                      @endforeach
                  @else
                      <p>No data available</p>
                  @endif
              </div>   
            </section>
            <!-- button buy -->
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="pay-button" class="bg-orange-400 w-full py-2 text-white rounded-md" type="button">
                Bayar sekarang
            </button>
            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400 capitalize">apakah data yang anda isi sudah sesuai?</h3>
                            <div class="flex flex-col gap-y-2">
                                <button data-modal-hide="popup-modal" id="confirm-button" class="bg-orange-400 w-full py-2.5 text-white rounded-md">
                                    kirim sekarang
                                </button>
                                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batalkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </form>
    </div>
  @endsection