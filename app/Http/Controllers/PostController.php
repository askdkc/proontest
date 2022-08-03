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

        $query->orWhere('title', 'like', '%ジョバンニ%');
        $query->orWhere('title', 'like', '%牛%');
        $query->orWhere('title', 'like', '%斉藤%');

        $query->orWhere('body', 'like', '%ジョバンニ%');
        $query->orWhere('body', 'like', '%牛%');
        $query->orWhere('body', 'like', '%斉藤%');

        $posts = $query->orderBy('id')->paginate(25);

        return view('results', \compact('posts'));
    }

    public function synonymzenbun()
    {
        $query = Post::query();

        $searchcolumn = ['title', 'body'];

        $keyword = "ジョバンニ OR 牛 OR 斉藤";

        // 各コラムを検索
        foreach($searchcolumn as $column)
        {
            $query->orWhereRaw($column . ' &@~ pgroonga_query_expand(?, ?, ?, ?)::varchar',['synonyms','terms','terms',$keyword]);
        }

        $posts = $query->paginate(25);

        return view('highlightresults', compact('posts','keyword'));
    }
}
