<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 ">
            <table class="divide-y divide-gray-200 w-4/5 max-w-4/5 p-8 m-8">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="w-9 px-6 py-3 text-left font-bold text-lg font-medium text-gray-500 uppercase">
                    ID
                  </th>
                  <th scope="col" class="w-30 max-w-min px-2 py-3 text-left font-bold text-lg font-medium text-gray-500 uppercase">
                    タイトル
                  </th>
                  <th scope="col" class="w-8/12 max-w-min px-6 py-3 text-left font-bold text-lg font-medium text-gray-500 uppercase">
                    本文
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach($posts as $post)
                <tr>
                  <td class="px-6 py-4 w-8">
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-900">{{$post->id}}</div>
                    </div>
                  </td>
                  <td class="px-2 py-4 w-30 max-w-min">
                    <div class="text-sm text-gray-900">{{$post->body['title']}}</div>
                  </td>
                  <td class="px-2 py-2 text-sm text-gray-500 w-8/12 max-w-min break-all">
                    <div class="text-sm text-gray-900">{{$post->body['memo']}}</div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            
        </div>
        <div class="w-full mx-auto items-top justify-center text-center">
        <div class="w-3/4 p-4 mx-auto">{{ $posts->links() }}</div>
        </div>
    </body>
</html>
