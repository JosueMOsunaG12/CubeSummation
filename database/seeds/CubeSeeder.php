<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Cube;
use App\Block;

class CubeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cube::create([
            'name'  => 'First Cube',
        ]);

        Block::create([
            'x'         => '1',
            'y'         => '1',
            'z'         => '1',
            'value'     => '23',
            'cube_id'   => '1',
        ]);

        Block::create([
            'x'         => '2',
            'y'         => '2',
            'z'         => '2',
            'value'     => '4',
            'cube_id'   => '1',
        ]);

        Block::create([
            'x'         => '2',
            'y'         => '2',
            'z'         => '3',
            'value'     => '7',
            'cube_id'   => '1',
        ]);
    }
}