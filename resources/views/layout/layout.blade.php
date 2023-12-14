<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ALL IN ONE TOPUP SERVICES</title>
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
    <header class="absolute top-0 left-0 w-full">
        @include('component.navbar')
    </header>
    <section class="flex flex-row justify-between items-center z-0">
        <div class="flex flex-col px-4 md:px-16 z-50 relative md:mt-0 text-center md:text-left w-full md:w-96 mt-40">
            <h5 class="mb-2 text-4xl md:text-5xl uppercase font-bold tracking-tight text-white">upgrade akunmu, kalahkan musuhmu</h5>
            <p class="mb-4 text-base md:text-lg text-white md:text-gray-400">Pilih layanan favoritmu dan nikmati layanan tersebut.</p>
            <a href="#topup" class="px-6 py-3 border rounded-md w-fit border-white text-xl text-white hover:bg-indigo-600 hover:border-indigo-600 transition-all duration-300">Beli Sekarang</a>
        </div>
        <div class="absolute inset-0 z-0 md:relative w-full pb-[18rem] md:pb-[36rem]">
            <video class="absolute w-full h-full object-cover" autoplay loop muted playsinline>
              <source src="{{ asset('/mlbb.mp4') }}" type="video/mp4">
            </video>
            <div class="w-full h-full bg-gradient-to-b from-black/10 to-black absolute inset-0"></div>
            <div class="w-full h-full bg-gradient-to-l from-black/10 to-black absolute inset-0"></div>
        </div>        
    </section>
    <main class="z-50 relative my-6" id="topup" >
        @yield('content')
    </main>
    <p class="text-sm text-slate-100 text-center my-4">Topup Mobile Legend 2023 - All rights reserved</p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
</body>
</html>