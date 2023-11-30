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
    <div class="w-96 absolute h-fit inset-0 p-4 bg-gray-900 ring-1 ring-gray-600 mx-auto mt-20 text-white rounded-md">
      <h1 class="text-center mb-6 text-2xl"> Detail Topup Diamond</h1>
      <div class="space-y-2">
        <div class="flex items-center justify-between">
          <h5>Nomer Invoice :</h5>
          <p>{{ $invoice->trx_id }}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5>Status Pembayaran :</h5>
          <p>{{ $status }}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5>Total Bayar :</h5>
          <p>Rp {{ $invoice->total_price }}</p>
        </div>
      </div>
      <div class="flex flex-col space-y-2">
        <button class="w-full py-2 bg-orange-400 mt-4 rounded-md" id="pay-button">Bayar sekarang</button>
        <a href="/" class="w-full py-2 bg-gray-800 mt-4 rounded-md text-center">Batalkan</a>
      </div>
    </div>
    <p class="text-sm text-white text-center absolute bottom-5 inset-x-0">Topup Gaming 2023 - All right reserved</p>
    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE wih5 your transaction token
        window.snap.pay('{{$snapToken   }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
  </body>
</html>