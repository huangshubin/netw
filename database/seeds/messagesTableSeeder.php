<?php

use Illuminate\Database\Seeder;

class messagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->comment('running message');
     factory(App\Models\Message::class,50)->create();
    }
}
