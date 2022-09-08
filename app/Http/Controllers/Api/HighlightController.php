<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighlightController extends Controller
{
    public function __invoke(String $text, String $keyword)
    {
        // TODO: Implement __invoke() method.

         $html = ( DB::select("select pgroonga_highlight_html('$text', " .
            "pgroonga_query_extract_keywords(pgroonga_query_expand('synonyms','terms','terms','$keyword')::varchar))" .
            "AS highlighted_text")[0] );

         return $html;
    }
}
