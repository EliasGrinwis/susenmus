<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Admin panel' }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
<div class="flex flex-col space-y-4 min-h-screen text-gray-800 bg-gray-100">
    <header class="bg-gray-900 text-gray-400 w-64 h-screen fixed top-0 left-0">
        {{-- Nagiation --}}
        @livewire('layout.admin.nav-bar')
    </header>

    <main class="ml-64 p-6">
        {{-- Main content --}}
        {{ $slot }}
    </main>
</div>

@stack('script')
@livewireScripts
</body>
</html>
