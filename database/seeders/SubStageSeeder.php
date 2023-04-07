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
        SubStage::create(['stage_id'=> 1,'name' => 'ENQUIRY REGISTER UPDATION','url'=>'enquiry_register/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'PRODUCT INFORMATION DATA','url'=>'product_information_data/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'MANUFACTURING FEASIBILITY REVIEW','url'=>'mfr/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'RISK ANALYSIS','url'=>'risk_analysis/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'QUOTE PREPARATION & SUBMISSION','url'=>'quote_preparation/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'CUSTOMER SPECIFIC REQUIREMENTS','url'=>'customer_requiements/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'IDENTIFICATION OF SPECIAL CHARACTERISTICS','url'=>'special_characteristics/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'IDENTIFICATION GAUGE & TESTING EQUIPEMENT','url'=>'gauge_equipment/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'EXPERIENCE SHARING (TGW)','url'=>'experience_sharing/create?id=']);
        SubStage::create(['stage_id'=> 1,'name' => 'MANAGEMENT REVIEW & SUPPORT MEETING I','url'=>'management_review/meeting_id=1&create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'PROCESS FLOW DIAGRAM','url'=>'process_flow_diagram/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'PROTO CONTROL PLAN RELEASE','url'=>'proto_control_plan/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'PROCESS FMEA','url'=>'process_failure_analysis/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'GAUGE DESIGN & DEVELOPMENT','url'=>'gauge_design_and_development/create?id=']);
        // SubStage::create(['stage_id'=> 2,'name' => 'PROCUREMENT OF GAUGE & TESTING EQUIPEMENT']);
        // SubStage::create(['stage_id'=> 2,'name' => 'GAUGE CALIBRATION']);
        // SubStage::create(['stage_id'=> 2,'name' => 'TOOL DESIGN']);
        // SubStage::create(['stage_id'=> 2,'name' => 'TOOL MANUFACTURING']);
        // SubStage::create(['stage_id'=> 2,'name' => 'TOOL INSPECTION & ASSEMBLY']);
        SubStage::create(['stage_id'=> 2,'name' => 'DEVELOPMENT OF SUBCONTRACTOR PROCESS','url'=>'subcontract_process/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'PRE LAUNCH CONTROL PLAN','url'=>'prelaunch_control_plan/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'WORK INSTRUCTIONS','url'=>'work_instructions/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'SIR SAMPLE SUBMISSION','url'=>'sample_submission/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'SIR SAMPLE APPROVAL','url'=>'sample_approval/create?id=']);
        SubStage::create(['stage_id'=> 2,'name' => 'MANAGEMENT REVIEW & SUPPORT MEETING II','url'=>'management_review/meeting_id=2&create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'PRODUCTION CONTROL PLAN RELEASE','url'=>'production_control_plan/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'PILOT LOT','url'=>'pilot_lot/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'MSA STUDY ( VARIABLE&ATTRIBUTE)','url'=>'msa_study/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'SPC STUDY','url'=>'spc_study/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'PROCESS DESIGN GOALS','url'=>'process_design_goal/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'PACKING SPECIFICATION PREPARATION','url'=>'packing_specification/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'PTR SIGN OFF','url'=>'ptr_signoff/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'PPAP PREPARATION & SUBMISSION','url'=>'ppap_preparation/create?id=']);
        SubStage::create(['stage_id'=> 3,'name' => 'MANAGEMENT REVIEW & SUPPORT MEETING III','url'=>'management_review/meeting_id=3&create?id=']);
        SubStage::create(['stage_id'=> 4,'name' => 'CUSTOMER APPROVAL OF PPAP & RELEASE OF CUSTOMER SOP','url'=>'customer_approval_of_ppap/create?id=']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH 1','url'=>'safe_launch/safe_launch=1&create?id=']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH 2','url'=>'safe_launch/safe_launch=2&create?id=']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH 3','url'=>'safe_launch/safe_launch=3&create?id=']);
        SubStage::create(['stage_id'=> 4,'name' => 'SAFE LAUNCH SIGN OFF','url'=>'safe_launch/safe_launch=4&create?id=']);
        SubStage::create(['stage_id'=> 4,'name' => 'CUSTOMER FEEDBACK &  MANAGEMENT REVIEW & SUPPORT MEETING IV','url'=>'management_review/meeting_id=4&create?id=']);

    }
}
