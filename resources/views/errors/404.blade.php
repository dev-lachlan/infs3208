<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full">
    <main class="h-screen w-full flex flex-col justify-center items-center">
        <h1 class="text-9xl font-extrabold text-white tracking-widest">404</h1>
        <div class="bg-orange-500 px-2 text-sm rounded rotate-12 absolute">
            Page Not Found
        </div>
        <button class="mt-5">
            <a href="{{ route('home') }}" class="relative inline-block text-sm font-medium text-orange-500 group active:text-orange-500 focus:outline-none focus:ring">
                <span class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-orange-500 group-hover:translate-y-0 group-hover:translate-x-0"></span>
                <span class="relative block px-8 py-3 bg-gray-900 border border-current">Click to go home</span>
            </a>
        </button>
    </main>
</body>
</html>