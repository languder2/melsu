<?php

namespace Database\Seeders;

use App\Models\News\Category;
use Illuminate\Database\Seeder;

class NewsCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::create([
            'name' => 'Главное в МелГУ',
            'sort' => 100,
        ]);

        Category::create([
            'name' => 'Гранты, конкурсы, форумы, конференции',
            'sort' => 200,
        ]);

        Category::create([
            'name' => 'Наука',
            'sort' => 300,
        ]);

        Category::create([
            'name' => 'Партнерство',
            'sort' => 400,
        ]);

        Category::create([
            'name' => 'РУМЦ',
            'sort' => 500,
        ]);

        Category::create([
            'name' => 'Спорт',
            'sort' => 600,
        ]);
    }
}
