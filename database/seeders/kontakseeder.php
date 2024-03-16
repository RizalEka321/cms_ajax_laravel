<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class kontakseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kontak = [
            [
                'slug' => 'saya',
                'email' => 'bsm@gmail.com',
                'no_hp' => '+6281357288268'
            ],
        ];

        Kontak::insert($kontak);
    }
}
