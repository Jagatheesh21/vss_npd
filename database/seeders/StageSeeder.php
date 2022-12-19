<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stage;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stage::create(['name' => 'PLAN AND DEFINE PROGRAM','description' => 'STAGE - 1']);
        Stage::create(['name' => 'PROCESS DESIGN AND DEVELOPMENT','description' => 'STAGE - 2']);
        Stage::create(['name' => 'MANUFACTURING PROCESS VALIDATION','description' => 'STAGE - 3']);
        Stage::create(['name' => 'FEEDBACK ASSESMENT AND CORRECTIVE ACTION','description' => 'STAGE - 4']);

    }
}
