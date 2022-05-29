<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->jsonb('body');
            $table->timestamps();
            
            // PGROONGAのEXTENSIONない人用
            DB::statement("CREATE EXTENSION pgroonga;");

            $table->index([
                'id',
                // var_charには
                DB::raw('title pgroonga_varchar_full_text_search_ops_v2'),
            ], null, 'pgroonga');

            $table->index([
                // jsonbは別インデックス
                DB::raw('body pgroonga_jsonb_ops_v2')
            ], null, 'pgroonga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        DB::statement("DROP EXTENSION pgroonga;");
    }
};
