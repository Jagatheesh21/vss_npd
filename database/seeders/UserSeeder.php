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
            'name' => 'MSV',
            'email' => 'msv@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
         User::create([
            'name' => 'LDP',
            'email' => 'ld@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Naveen',
            'email' => 'r.naveen@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Marimuthu',
            'email' => 'marimuthu@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Murugan',
            'email' => 'qad@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Muthuraja',
            'email' => 'qms@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Kiruba',
            'email' => 'kiruba@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);
        User::create([
            'name' => 'Ajith',
            'email' => 'npd@venkateswarasteels.com',
            'password' => bcrypt('vssipl@123'),
        ]);

    }
}
