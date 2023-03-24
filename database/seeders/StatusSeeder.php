<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'PENDING','colour' => 'Y','active'=>1]);
        Status::create(['name' => 'REJECTED','colour' => 'R','active'=>1]);
        Status::create(['name' => 'OVERDUE','colour' => 'O','active'=>1]);
        Status::create(['name' => 'COMPLETED','colour' => 'G','active'=>1]);

    }
}
