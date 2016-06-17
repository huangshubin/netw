<?php

use Illuminate\Database\Seeder;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->comment('running user');
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name'=>'shubin1211',
            'email'=>'shubin@1211',
            'is_admin'=>1,
            'permissions'=>0b00000001|0b00000010|0b00000100|0b00001000|0b00010000|0b00100000,
            'password'=>bcrypt('111111'),

        ]);

        factory(App\Models\User::class,50)->create();
    }
}
