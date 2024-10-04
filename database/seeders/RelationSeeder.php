<?php

namespace Database\Seeders;

use App\Models\Relation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Relation::insert([
            ['title' => 'Friend & Friend'],
            ['title' => 'Husband & Wife'],
        ]);
    }
}
