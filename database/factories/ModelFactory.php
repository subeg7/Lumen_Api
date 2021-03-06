<?php
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Sms;
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

$factory->define(User::class, function (Faker\Generator $faker) {
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

$factory->define(Sms::class,function(){
  $user = User::inRandomOrder()->get()->first();
  // $quote = json_encode(file_get_contents("http://quotesondesign.com/wp-json/posts?filter[orderby]=rand&filter[posts_per_page]=1"))->content;
  // echo $quote;
   return[
     'message'=>"This is ".$user->name.". Contact me at ".$user->email.". See you at, August".$user->id,
     'user_id'=>$user->id
  //
  ];

});
