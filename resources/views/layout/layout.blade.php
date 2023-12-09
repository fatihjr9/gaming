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
        .btn-home {
            position: relative;
            background-color: none;
            border: 1px solid #c0c0c0;
            color: #fff;
            padding: 1rem;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            overflow: hidden;
        }
        .btn-home::before {
            content: "";
            position: absolute;
            background-color: #c0c0c0;
            color: #fff;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            transition: left 0.3s;
        }
        .btn-home:hover::before {
            left: 0;
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
            <h5 class="mb-2 text-5xl uppercase font-bold tracking-tight text-white">upgrade akunmu, kalahkan musuhmu</h5>
            <p class="mb-4 text-lg text-white md:text-gray-600">Discover some packages diamond with reasonable price</p>
            <a href="#topup" class="btn-home">Beli Sekarang</a>
            <a href="#topup" class="block md:hidden mx-auto px-6 py-3 border rounded-md w-fit border-white text-xl text-white hover:bg-indigo-600 hover:border-indigo-600 transition-all duration-300">Beli Sekarang</a>
        </div>
        <div class="absolute inset-0 z-0 md:relative w-full pb-[18rem] md:pb-[36rem]">
            <video class="absolute w-full h-full object-cover" autoplay loop muted playsinline>
              <source src="{{ asset('/mlbb.mp4') }}" type="video/mp4">
            </video>
            <div class="w-full h-full bg-gradient-to-b from-black/10 to-black absolute inset-0"></div>
            <div class="w-full h-full bg-gradient-to-l from-black/10 to-black absolute inset-0"></div>
        </div>        
    </section>
    <main class="z-50 relative my-6" id="topup">
        @yield('content')
    </main>
    <p class="text-sm text-slate-100 text-center my-4">Topup Mobile Legend 2023 - All rights reserved</p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
</body>
</html>