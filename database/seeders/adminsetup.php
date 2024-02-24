<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminsetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => '$2y$10$v7PiyKvtl9UtzJq8a97h0.aGwH4efsWGkkbWbXV0ATkAKCtH6HH7C', 'user_type'=> ADMIN_ROLE],
        ];

        User::insert($data);
    }
}
