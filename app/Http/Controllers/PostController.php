<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function simplelike()
    {
        $query = Post::query();

        $query->Where('title', 'like', '%ジョバンニ%');
        $query->Where('title', 'like', '%銀河%');
        $query->orWhere('body', 'like', '%ジョバンニ%');
        $query->Where('body', 'like', '%銀河%');

        $posts = $query->orderBy('id')->paginate(20);

        return view('results', \compact('posts'));
    }

    public function zenbun()
    {
        $query = Post::query();

        $query->orWhereRaw('title &@~ ?', ['ジョバンニ 銀河']);
        $query->orWhereRaw('body &@~ ?', ['ジョバンニ 銀河']);

        $posts = $query->orderBy('id')->paginate(20);

        return view('results', \compact('posts'));
    }
}
