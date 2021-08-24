<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
