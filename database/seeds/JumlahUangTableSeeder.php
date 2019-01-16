<?php

use Illuminate\Database\Seeder;
use App\JumlahUang;
class JumlahUangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JumlahUang::create(['uang' => 0]);
    }
}
