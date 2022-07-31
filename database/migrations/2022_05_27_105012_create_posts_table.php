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
            $table->text('body');
            $table->timestamps();

            // PGROONGAのEXTENSIONない人用
            DB::statement("CREATE EXTENSION IF NOT EXISTS pgroonga;");

            $table->index(['id'], null,'pgroonga');

            $table->index([
                // var_charにはpgroonga_varchar_full_text_search_ops_v2
                DB::raw('title pgroonga_varchar_full_text_search_ops_v2'),
            ], null, 'pgroonga');

            $table->index([
                // textにはpgroonga_text_full_text_search_ops_v2
                DB::raw('body pgroonga_text_full_text_search_ops_v2')
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
