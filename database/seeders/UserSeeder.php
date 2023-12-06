<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Wilmer Diaz',
            'email' => 'wilmerd581@gmai.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');;

        User::factory(100)->create();
    }
}
