<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'omar abdulaziz',
            'email' => 'om.dev.422@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
