<?php

namespace Database\Seeders;

use App\Models\News\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        NewsCategory::create([
            'name' => 'Главное в МелГУ',
            'sort' => 100,
        ]);

        NewsCategory::create([
            'name' => 'Гранты, конкурсы, форумы, конференции',
            'sort' => 200,
        ]);

        NewsCategory::create([
            'name' => 'Наука',
            'sort' => 300,
        ]);

        NewsCategory::create([
            'name' => 'Партнерство',
            'sort' => 400,
        ]);

        NewsCategory::create([
            'name' => 'РУМЦ',
            'sort' => 500,
        ]);

        NewsCategory::create([
            'name' => 'Спорт',
            'sort' => 600,
        ]);
    }
}
