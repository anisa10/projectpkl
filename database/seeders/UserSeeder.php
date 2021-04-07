<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "syahrul";
        $user->email = "syahrul@gmail.com";
        $user->password = bcrypt('qwertyuiop');
        $user->save();
    }
}
