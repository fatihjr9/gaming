<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-EbZpArANxHBj9XHL"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <title>TOPUP GAMING</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css"  rel="stylesheet" />
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            #topup {
                scroll-behavior: smooth;
            }
        }
    </style>
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
    <div class="w-96 absolute gap-y-4 h-fit inset-0 p-4 bg-gray-900 ring-1 ring-gray-600 mx-auto mt-20 text-white rounded-md">
      <h1 class="text-center mb-6 text-2xl">Invoice Diamond ML</h1>
      <div class="space-y-2 mb-4">
        <div class="flex items-center justify-between">
          <h5>Transaction ID :</h5>
          <p>{{ $trx_id}}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5>ID User :</h5>
          <p> {{ $invoice-> user_id}}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5>Zone :</h5>
          <p> {{ $invoice-> user_zone}}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5>Status :</h5>
          <p>{{ $invoice->status }}</p>
        </div>
      </div>
      <div class="w-full py-2 bg-gray-800 rounded-md text-center">
        <a href="/">Kembali ke halaman utama</a>
      </div>
    </div>
    <p class="text-sm text-white text-center absolute bottom-5 inset-x-0">Topup Gaming 2023 - All right reserved</p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
  </body>
</html>