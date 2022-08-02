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
            "pgroonga_query_extract_keywords('$keyword'))" .
            "AS highlighted_$column")[0] );

        $returnculumn = "highlighted_" . $column;
        
        return $html->$returnculumn;

    }

}
