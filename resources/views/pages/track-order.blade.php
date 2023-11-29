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
    <img class="w-full h-[30rem] bg-center bg-blend-normal object-cover bg-no-repeat z-0 relative" src="{{ asset('/peakpx.jpg') }}" alt="">
    <div class="w-full h-[30rem] bg-gradient-to-b from-black/20 to-black absolute top-0 left-0"></div>
    <section class="w-full md:w-8/12 grid grid-cols-1 md:grid-cols-2 absolute h-fit inset-0 p-4 bg-gray-900/80 ring-1 ring-gray-600 mx-auto mt-20 text-white rounded-md">
      {{-- result --}}
      <div class="p-2">
        <h1 class="mb-6 text-2xl">Detail Transaksi Diamond</h1>
        <div class=" h-60 bg-gray-900 overflow-y-scroll ring-1 ring-gray-600 rounded-md">
          @if(isset($responseData['result']) && $responseData['result'])
              @foreach($responseData['data'] as $transaction)
                  <div class="mt-4 p-2 rounded-md ring-1 ring-gray-100 mx-4">
                      <p>Status: <span class="text-green-500">{{ $transaction['status'] }}</span></p>
                      <p>Transaction ID: {{ $transaction['trxid'] }}</p>
                      <p>Amount: {{ $transaction['price'] }}</p>
                      <!-- Add more details as needed -->
                  </div>
              @endforeach
          @else
              <div class="mt-4 text-red-500">
                  {{ $responseData['message'] }}
              </div>
          @endif
        </div>
      </div>    
      {{-- form --}}
      <form action="{{ route('lacak-pesanan') }}" method="POST" class="w-80 ml-auto">
        @csrf
        <div class="flex flex-col gap-y-2">
            <label for="trxid">Transaction ID:</label>
            <input type="text" id="trxid" name="trxid" class="p-2 bg-black/50 text-white border border-white rounded-md" required>
        </div>
        <button type="submit" class="w-full py-2 bg-orange-400 mt-4 rounded-md">Cek sekarang</button>
      </form>
    </section>
    <p class="text-sm text-white text-center absolute bottom-5 inset-x-0">Topup Gaming 2023 - All right reserved</p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
  </body>
</html>