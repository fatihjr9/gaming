@extends('layout.layout')

@section('content')
  <div class="grid grid-cols-1 md:grid-cols-2">
    {{-- Stepper --}}
    <div class="flex flex-col gap-y-8">
      <h5 class="text-2xl text-white font-semibold">Cara Order</h5>
      <ol class="relative text-gray-500 border-s border-gray-200 dark:border-gray-700 dark:text-gray-400">                  
        <li class="mb-10 ms-6">            
            <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100  rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700 ">
              <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
              </svg>
            </span>
            <h3 class="font-medium leading-tight">Fill the form</h3>
            <p class="text-sm">Isi form id dan zone, pilih paket dan metode pembayaran</p>
        </li>
        <li class="mb-10 ms-6">
            <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                </svg>
            </span>
            <h3 class="font-medium leading-tight">Account Info</h3>
            <p class="text-sm">Pastikan data sesuai dengan yang diinginkan</p>
        </li>
        <li class="mb-10 ms-6">
            <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                </svg>
            </span>
            <h3 class="font-medium leading-tight">Review</h3>
            <p class="text-sm">Receipt akan muncul dan segeralah membayar</p>
        </li>
        <li class="ms-6">
            <span class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900">
                <svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                </svg>
            </span>
            <h3 class="font-medium leading-tight">Sukses</h3>
            <p class="text-sm">Transaksi diamond berhasil, silakan cek di akun kalian</p>
        </li>
      </ol>
    </div>

    {{-- order --}}
    <form action="{{ route('place-order') }}" method="POST" class="flex flex-col gap-y-2">
      @csrf
      {{-- Input --}}
      <div class="flex flex-col gap-y-2">
        <input type="text" name="idUser" placeholder="Masukkan ID" class="p-2 bg-black/50 text-white border border-white rounded-md">
        <input type="text" name="zone" placeholder="Masukkan Zone" class="p-2 bg-black/50 text-white border border-white rounded-md">
      </div>
      <!-- Pricing -->
      <h5 class="text-white">Pilih paket</h5>
      <select name="categories" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 space-y-2">
          @if(isset($data['data']))
              @foreach($data['data'] as $feature)
                  <option id="{{ $feature['code'] }}">
                      <div class="flex flex-col">
                          <label for="{{ $feature['code'] }}" class="flex flex-row items-center gap-x-2 w-full ms-2 text-sm font-semibold text-gray-900 dark:text-gray-300">
                              <img class="w-4 h-4" src="{{ asset('/diamond.png') }}" alt="">
                              {{ $feature['name'] }}
                          </label>
                          <span>|</span>
                          <label for="{{ $feature['code'] }}" class="w-full ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Rp {{ $feature['price']['basic'] }}</label>
                      </div>
                  </option>
              @endforeach
          @else
              <p>No data available</p>
          @endif
      </select>
      <!-- button buy -->
      <button class="bg-orange-400 w-full py-2 text-white rounded-md" type="submit" name="submit">
          Bayar sekarang
      </button>
    </form>
  </div>
@endsection