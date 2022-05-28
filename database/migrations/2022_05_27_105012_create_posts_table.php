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
            
            // PGROONGAのEXTENSION無い人用
            DB::statement("CREATE EXTENSION pgroonga;");

            $table->index([
                'id',
                // varcharにはfull_textを指定必要
                DB::raw('title pgroonga_varchar_full_text_search_ops_v2'),
                'body'
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
