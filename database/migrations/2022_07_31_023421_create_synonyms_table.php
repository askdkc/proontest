<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synonyms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        // Array Typeサポートされてないので直接DB::statement
        DB::statement('ALTER TABLE synonyms ADD COLUMN terms text[]');

        // PGroongaでインデックス作る
        Schema::table('synonyms', function (Blueprint $table) {
            $table->index([DB::raw('terms pgroonga_text_array_full_text_search_ops_v2'),], null,'pgroonga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('synonyms');
    }
};
