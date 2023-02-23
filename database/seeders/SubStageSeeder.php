<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubStage;

class SubStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubStage::create(['stage_id'=> 1,'name' => 'ENQUIRY REGISTER UPDATION']);
        SubStage::create(['stage_id'=> 1,'name' => 'PRODUCT INFORMATION DATA']);
        SubStage::create(['stage_id'=> 1,'name' => 'MANUFACTURING FEASIBILITY REVIEW']);
        SubStage::create(['stage_id'=> 1,'name' => 'RISK ANALYSIS']);
        SubStage::create(['stage_id'=> 1,'name' => 'QUOTE PREPARATION & SUBMISSION']);
        SubStage::create(['stage_id'=> 1,'name' => 'CUSTOMER SPECIFIC REQUIREMENTS']);
        SubStage::create(['stage_id'=> 1,'name' => 'IDENTIFICATION OF SPECIAL CHARACTERISTICS']);
        SubStage::create(['stage_id'=> 1,'name' => 'IDENTIFICATION GAUGE & TESTING EQUIPEMENT']);
        SubStage::create(['stage_id'=> 1,'name' => 'EXPERIENCE SHARING (TGW)']);
        SubStage::create(['stage_id'=> 1,'name' => 'MANAGEMENT REVIEW & SUPPORT MEETING I']);
        SubStage::create(['stage_id'=> 2,'name' => 'PROCESS FLOW DIAGRAM']);
        SubStage::create(['stage_id'=> 2,'name' => 'PROTO CONTROL PLAN RELEASE']);
        SubStage::create(['stage_id'=> 2,'name' => 'PROCESS FMEA']);
        SubStage::create(['stage_id'=> 2,'name' => 'GAUGE DESIGN & DEVELOPMENT']);
        // SubStage::create(['stage_id'=> 2,'name' => 'PROCUREMENT OF GAUGE & TESTING EQUIPEMENT']);
        // SubStage::create(['stage_id'=> 2,'name' => 'GAUGE CALIBRATION']);
        // SubStage::create(['stage_id'=> 2,'name' => 'TOOL DESIGN']);
        // SubStage::create(['stage_id'=> 2,'name' => 'TOOL MANUFACTURING']);
        // SubStage::create(['stage_id'=> 2,'name' => 'TOOL INSPECTION & ASSEMBLY']);
        SubStage::create(['stage_id'=> 2,'name' => 'DEVELOPMENT OF SUBCONTRACTOR PROCESS']);
        SubStage::create(['stage_id'=> 2,'name' => 'PRE LAUNCH CONTROL PLAN']);
        SubStage::create(['stage_id'=> 2,'name' => 'WORK INSTRUCTIONS']);
        SubStage::create(['stage_id'=> 2,'name' => 'SIR SAMPLE SUBMISSION']);
        SubStage::create(['stage_id'=> 2,'name' => 'MANAGEMENT REVIEW & SUPPORT MEETING II']);
        SubStage::create(['stage_id'=> 3,'name' => 'PRODUCTION CONTROL PLAN RELEASE']);
        SubStage::create(['stage_id'=> 3,'name' => 'PILOT LOT']);
        SubStage::create(['stage_id'=> 3,'name' => 'MSA STUDY ( VARIABLE&ATTRIBUTE)']);
        SubStage::create(['stage_id'=> 3,'name' => 'SPC STUDY']);
        SubStage::create(['stage_id'=> 3,'name' => 'PROCESS DESIGN GOALS']);
        SubStage::create(['stage_id'=> 3,'name' => 'PACKING SPECIFICATION PREPARATION']);
        SubStage::create(['stage_id'=> 3,'name' => 'PTR SIGN OFF']);
        SubStage::create(['stage_id'=> 3,'name' => 'PPAP PREPARATION & SUBMISSION']);
        SubStage::create(['stage_id'=> 3,'name' => 'MANAGEMENT REVIEW & SUPPORT MEETING III']);
        SubStage::create(['stage_id'=> 4,'name' => 'CUSTOMER APPROVAL OF PPAP & RELEASE OF CUSTOMER SOP ']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH 1']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH 2']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH 3']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH SIGN OFF']);
        SubStage::create(['stage_id'=> 4,'name' => 'CUSTOMER FEEDBACK &  MANAGEMENT REVIEW & SUPPORT MEETING IV']);
        
    }
}
