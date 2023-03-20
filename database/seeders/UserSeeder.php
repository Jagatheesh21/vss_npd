<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@123'),
        ]);
        User::create([
            'name' => 'Marimuthu',
            'email' => 'npd@venakateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Murugan',
            'email' => 'qad@venakateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Muthuraja',
            'email' => 'qms@venakateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Kiruba',
            'email' => 'kiruba@venakateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Ajith',
            'email' => 'ajith@venakateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Dhanapal NPD',
            'email' => 'dhanapal@venakateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
    }
}
