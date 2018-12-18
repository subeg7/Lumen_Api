<?php
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
      'name'     => $faker->name,
      'email'    => $faker->unique()->email,
      'password' => Hash::make('12345'),
      'api_key'  => function(){
                        $charid = strtoupper(md5(uniqid(rand(),true)));
                        $hypen = chr(45); //'-'
                        $uuid = chr(123)//'{'
                                .substr($charid,0,8).$hypen
                                .substr($charid,8,4).$hypen
                                .substr($charid,12,4).$hypen
                                .substr($charid,16,4).$hypen
                                .substr($charid,20,12)
                                .chr(125);//'}'
                        mt_srand((double)microtime()*10000);
                        return $uuid;
                      }

    ];
});
