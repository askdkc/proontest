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
            DB::statement("CREATE EXTENSION IF NOT EXISTS pgroonga;");

        });


        Schema::table('posts', function (Blueprint $table) {
            DB::statement("CREATE INDEX pgroonga_index_title ON posts using pgroonga (\"title\" pgroonga_varchar_full_text_search_ops_v2);");

            DB::statement("CREATE INDEX pgroonga_index_jsonb_body ON posts using pgroonga (\"body\" pgroonga_jsonb_ops_v2);");
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
