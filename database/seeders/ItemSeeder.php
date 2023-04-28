<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => 'ワンピース',
                'author' => '尾田栄一郎',
                'maker' => '集英社',
                'isbn' => '12345678',
                'number_stock' => '100',
            ],
            [
                'name' => 'ドラゴンボール',
                'author' => '鳥山',
                'maker' => '集英社',
                'isbn' => '12345677',
                'number_stock' => '100',
            ],
            [
                'name' => 'ナルト',
                'author' => '太郎',
                'maker' => '集英社',
                'isbn' => '12345448',
                'number_stock' => '100',
            ]
        ]);
    }
}
