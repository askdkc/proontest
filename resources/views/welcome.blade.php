<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>Laravel</title>


    </head>
    <body class="antialiased">
            <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 ">
                <div class="m-2 p-2">
                    <a href="{{ route('like') }}" class="text-lg text-blue-600 underline">LIKE検索</a>
                </div>
                <div class="m-2 p-2">
                    <a href="{{ route('zenbun') }}" class="text-lg text-blue-600 underline">PGroonga &@~全文検索</a>
                </div>
            </div>
    </body>
</html>
