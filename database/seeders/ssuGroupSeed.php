<?php

namespace Database\Seeders;

use App\Models\Structure\suStructure;
use Illuminate\Database\Seeder;

class ssuGroupSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        suStructure::CreateGroup([
            [
                'name' => 'Ректорат',
                'sort' => 100
            ],
            [
                'name' => 'Департаменты',
                'sort' => 200
            ],
            [
                'name' => 'Управления',
                'sort' => 300
            ],
            [
                'name' => 'Отделы',
                'sort' => 400
            ],
            [
                'name' => 'Центры',
                'sort' => 500
            ],
            [
                'name' => 'Институты',
                'sort' => 600
            ],
            [
                'name' => 'Лаборатории',
                'sort' => 700
            ],
        ]);
    }
}
