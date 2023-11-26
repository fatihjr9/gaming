<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <section>
        <img class="w-full h-[30rem] bg-center bg-blend-normal object-cover bg-no-repeat z-0 relative" src="{{ asset('/peakpx.jpg') }}" alt="">
        <div class="w-full h-[30rem] bg-gradient-to-b from-black/20 to-black absolute top-0 left-0"></div>
        <div class="flex flex-col -translate-y-72 text-center gap-y-6">
            <h5 class="text-6xl md:text-7xl uppercase font-bold tracking-tight text-white">buktikan kalau skin <br class="hidden md:block"> anda level dewa</h5>
            <a href="#topup" class="px-6 py-3 border rounded-full w-fit mx-auto border-white text-xl text-white">Beli Sekarang</a>
        </div>
    </section>
    <header class="absolute top-0 left-0 w-full">
        @include('component.navbar')
    </header>
    <main class="px-4 md:px-16 mb-8" id="topup">
        @yield('content')
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
</body>
</html>