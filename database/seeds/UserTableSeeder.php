<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   //  	for ($i=0; $i<100 ; $i++) { 
	  //       $user = User::create([
	  //           'email' => $i."eam24maret@gmail.com",
	  //           'password' => Hash::make("ersaazis"),

	  //           'name' => "Ersa Azis Mansyur",
	  //           'avatar' => "14011979phpA2K4mm.jpg",
	  //           'birthplace' => "Garut",
	  //           'dateofbirth' => "1998-02-04",
	  //           'aboutme' => "Learn Anything Share Anything",
	  //           'address' => "WAKANDA",
	  //           'website' => "http://ersaazis.github.io",
	  //           'visible' => rand(0,1),
			// ]);
	  //       $user->assignRole([1]);
   //  	}
        $user = User::create([
            'email' => "eam24maret@gmail.com",
            'password' => Hash::make("ersaazis"),

            'name' => "Ersa Azis Mansyur",
            'birthplace' => "Garut",
            'dateofbirth' => "1998-02-04",
            'aboutme' => "Learn Anything Share Anything",
            'address' => "WAKANDA",
            'website' => "http://ersaazis.github.io",
		]);
        $user->assignRole([1]);
        $file=public_path()."/svg/gambarasli.jpg";
        $user->addMedia($file)->toMediaCollection('avatars');
    }
}
