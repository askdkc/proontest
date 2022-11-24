<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function highlight($data, $column, $keyword)
    {

        $html = ( DB::select("select pgroonga_highlight_html('$data', " .
            "pgroonga_query_extract_keywords(pgroonga_query_expand('synonyms','terms','terms','$keyword')::varchar))" .
            "AS highlighted_$column")[0] );

        $returncolumn = "highlighted_" . $column;

        return $html->$returncolumn;

    }

    public static function snippet($data, $column, $keyword)
    {

        $html = ( DB::select("select unnest(pgroonga_snippet_html('$data', " .
            "pgroonga_query_extract_keywords(pgroonga_query_expand('synonyms','terms','terms','$keyword')::varchar)))" .
            "AS highlighted_$column") );

        $returncolumn = "highlighted_" . $column;

        return $html ? $html[0]->$returncolumn : mb_substr($data, 0, 50);

    }

}
