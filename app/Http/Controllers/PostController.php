<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    
    public function simplelike()
    {
        $query = Post::query();

        $query->Where('body->memo', 'like', '%ジョバンニ%');
        $query->Where('body->memo', 'like', '%銀河%');
        $query->orWhere('body->maintext', 'like', '%ジョバンニ%');
        $query->Where('body->maintext', 'like', '%銀河%');

        $posts = $query->orderBy('id')->paginate(20);

        return view('results', \compact('posts'));
    }

    public function zenbun()
    {
        $query = Post::query();

        //上手く動く
        $query->orWhereRaw('body &` \'(paths @ "memo" || paths @ "maintext") && query("string", "ジョバンニ 銀河")\''); 

        // 受け取った検索キーワードを渡したいが上手く行かない
        // $query->orWhereRaw('body &` \'(paths @ "memo" || paths @ "maintext") && query("string", "?")\'', ["ジョバンニ 銀河"]); 

        $posts = $query->orderBy('id')->paginate(20);

        $posts = $query->paginate(20);

        return view('results', \compact('posts'));
    }
}
