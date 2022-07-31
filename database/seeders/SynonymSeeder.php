<?php

namespace Database\Seeders;

use App\Models\Synonym;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SynonymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Synonym::create([
            "terms" => "{さいとう,サイトウ,斉藤,斎藤,齋藤,齊藤}",
        ]);

        Synonym::create([
            "terms" => "{うし,ウシ,牛,丑,雄牛,雌牛,🐮}",
        ]);
    }
}
