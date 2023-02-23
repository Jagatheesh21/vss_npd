<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkInstructionSeeder extends Seeder
{
    protected $fillable = ['apqp_timing_plan_id','part_number_id','revision_number','revision_date','application','customer_id','product_description','reference_number','description','inspection_method','remarks'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}
