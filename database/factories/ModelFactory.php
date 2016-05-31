<?php

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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('111111'),
        'is_admin'=>rand(0,1),
        'permissions'=>array_rand(USER_PERMISSIONS,rand(1,6)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Message::class, function (Faker\Generator $faker) {

    $isReply=rand(0,1)==1;
    $replyMsg=$isReply?$faker->realText(500,2):null;
    return [
        'name' => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'message' => $faker->realText(500,1),
        'reply_message'=>$replyMsg,
        'is_reply'=>$isReply
    ];
});