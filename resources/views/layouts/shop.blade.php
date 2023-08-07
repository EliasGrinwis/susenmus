<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Admin panel' }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-manrope antialiased">

<style>
    .child {
        flex: 1 1 0px;
    }
</style>

<section style="background-color: #191919; height: 708px; /*border-bottom-right-radius: 50%*/">
    <header class="text-white">
        {{-- Nagiation --}}
        @livewire('nav-bar-shop')
    </header>
    <div class="container mx-auto flex items-center justify-between" style="height: 612px;">
        <div class="child">
            <h1 class="text-7xl text-white">Welkom bij <br> Sus&amp;Mus</h1>
            <p style="color: #6f7684" class="text-lg py-8">Ontdek de nieuwste trends in mode en stijl, en laat je <br>
                inspireren door onze unieke collecties.</p>
            <button class="uppercase inline-flex items-center px-4 py-3 border border-transparent text-white button">
                Nieuwe collectie
            </button>
        </div>
        <div class="child">
            <img src="hero.png" alt="Hero image">
        </div>
    </div>
</section>

<main>
    {{ $slot }}
</main>



@stack('script')
@livewireScripts

</body>
</html>
