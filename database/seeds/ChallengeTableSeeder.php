<?php

use Illuminate\Database\Seeder;
use App\Challenge;
class ChallengeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=['a','b','c','d','e','f','g'];
        foreach ($data as $d) {
             Challenge::create([
             	'name' => $d,
             	'point' => 10,
             	'note' => $d,
             	'flag' => $d,
             ]);
        }
    }
}
