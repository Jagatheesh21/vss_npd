<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartNumberController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\SubStageController;
use App\Http\Controllers\APQPTimingPlanController;
use App\Http\Controllers\APQPPlanActivityController;
use App\Http\Controllers\EnquiryRegisterController;
use App\Http\Controllers\ProductInformationDataController;
use App\Http\Controllers\ManufacturingFeasibilityReviewController;
use App\Http\Controllers\RiskAnalysisController;
use App\Http\Controllers\QuotePrepartionController;
use App\Http\Controllers\CustomerSpecificRequirementController;
use App\Http\Controllers\IdentificationOfSpecialCharacteristicController;
use App\Http\Controllers\IdentificationOfGaugeEquipmentController;
use App\Http\Controllers\ProcessFlowDiagramController;
use App\Http\Controllers\ProcessFailureAnalysisController;
use App\Http\Controllers\ToolDesignController;
use App\Http\Controllers\InspectionReportController;
use App\Http\Controllers\WorkInstructionController;
use App\Http\Controllers\PtrSignoffController;
use App\Http\Controllers\PreLaunchControlPlanController;
use App\Http\Controllers\ProtoControlPlanController;
use App\Http\Controllers\ProductionControlPlanController;
use App\Http\Controllers\ManagementReviewController;
use App\Http\Controllers\SubcontractProcessController;
use App\Http\Controllers\GaugeDesignAndDevelopementController;
use App\Http\Controllers\MsaStudyController;
use App\Http\Controllers\ExperienceSharingController;
use App\Http\Controllers\SampleSubmissionController;
use App\Http\Controllers\PilotLotController;
use App\Http\Controllers\PackingSpecificationPreparationController;
use App\Http\Controllers\PpapPreparationController;
use App\Http\Controllers\ProcessDesignGoalController;
use App\Http\Controllers\SpcStudyController;
use App\Http\Controllers\CustomerApprovalOfPpapController;
use App\Http\Controllers\SafeLaunchController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SirApprovalController;
use App\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::middleware(['auth'])->group(function () {
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('test_mail', [HomeController::class, 'test_mail'])->name('test_mail');
Route::get('change-password', [ChangePasswordController::class,'index'])->name('change_password');
Route::post('change-password', [ChangePasswordController::class,'store'])->name('change.password');
Route::get('customer/export/excel', [CustomerController::class, 'export_excel'])->name('customer.export_excel');
Route::get('customer/export/pdf', [CustomerController::class, 'export_pdf'])->name('customer.export_pdf');
Route::resource('customer',CustomerController::class);
Route::resource('part_number',PartNumberController::class);
Route::resource('stage',StageController::class);
Route::resource('sub_stage',SubStageController::class);
Route::get('apqp_timing_plan/plan_scheduler',[APQPTimingPlanController::class,'plan_scheduler'])->name('plan_scheduler');
Route::post('apqp_timing_plan/scheduler_update',[APQPTimingPlanController::class,'scheduler_update'])->name('scheduler_update');
Route::post('apqp_timing_plan/customers',[APQPTimingPlanController::class,'getCustomers'])->name('customers');
Route::post('apqp_timing_plan/plans',[APQPTimingPlanController::class,'getPlans'])->name('plans');
Route::post('apqp_timing_plan/schedule_plans',[APQPTimingPlanController::class,'getSchedulePlans'])->name('schedule_plans');
Route::post('apqp_timing_plan/plan_activities',[APQPTimingPlanController::class,'getPlanActivities'])->name('plan_activities');
Route::post('apqp_timing_plan/fetch_part_number',[APQPTimingPlanController::class,'fetch_part_number'])->name('fetch_part_number');
Route::get('apqp_timing_plan/export',[APQPTimingPlanController::class,'export'])->name('timing_plan.export');
Route::resource('apqp_timing_plan',APQPTimingPlanController::class);
Route::get('escalation_activity',[APQPPLanActivityController::class,'escalation_activity'])->name('escalation_activity');
Route::get('escalation_export',[APQPPLanActivityController::class,'escalation_export'])->name('escalation_export');
Route::get('activity/task_list',[APQPPLanActivityController::class,'task_list'])->name('task_list');
Route::resource('activity',APQPPLanActivityController::class);
Route::get('enquiry_register/verify',[EnquiryRegisterController::class,'verify'])->name('enquiry.verify');
Route::post('enquiry_register/save_register',[EnquiryRegisterController::class,'save_register'])->name('save_register');
Route::resource('enquiry_register',EnquiryRegisterController::class);
Route::get('enquiry_register/preview/{plan_id}/{sub_stage_id}',[EnquiryRegisterController::class,'preview'])->name('enquiry_register_preview');
Route::get('verification/task/{plan_id}/{sub_stage_id}',[VerificationController::class,'task'])->name('task');
<<<<<<< HEAD
Route::get('verification/preview/{plan_id}/{sub_stage_id}',[VerificationController::class,'preview'])->name('verification_preview');
// Route::get('mfr/preview/{plan_id}/{sub_stage_id}',[ManufacturingFeasibilityReviewController::class,'preview'])->name('preview');
// Route::get('mfr/preview/{plan_id}/{sub_stage_id}',[ManufacturingFeasibilityReviewController::class,'preview'])->name('preview');
=======
<<<<<<< HEAD
=======
Route::get('verification/preview/{plan_id}/{sub_stage_id}',[VerificationController::class,'preview'])->name('preview');
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
Route::resource('verification',VerificationController::class);
// Route::resource('verification/activity/',[VerificationController::class,'activity'])->name('activity');
Route::resource('product_information_data',ProductInformationDataController::class);
Route::get('product_information_data/preview/{plan_id}/{sub_stage_id}',[ProductInformationDataController::class,'preview'])->name('product_information_data_preview');
Route::resource('mfr',ManufacturingFeasibilityReviewController::class);
Route::get('mfr/preview/{plan_id}/{sub_stage_id}',[ManufacturingFeasibilityReviewController::class,'preview'])->name('mfr_preview');
Route::resource('risk_analysis',RiskAnalysisController::class);
Route::get('risk_analysis/preview/{plan_id}/{sub_stage_id}',[RiskAnalysisController::class,'preview'])->name('risk_analysis_preview');
Route::resource('quote_preparation',QuotePrepartionController::class);
Route::get('quote_preparation/preview/{plan_id}/{sub_stage_id}',[QuotePrepartionController::class,'preview'])->name('quote_preparation_preview');
Route::get('customer_requiements/preview/{plan_id}/{sub_stage_id}',[CustomerSpecificRequirementController::class,'preview'])->name('customer_requiements_preview');
Route::resource('customer_requiements',CustomerSpecificRequirementController::class);
Route::resource('special_characteristics',IdentificationOfSpecialCharacteristicController::class);
Route::get('special_characteristics/preview/{plan_id}/{sub_stage_id}',[IdentificationOfSpecialCharacteristicController::class,'preview'])->name('special_characteristics_preview');
Route::resource('gauge_equipment',IdentificationOfGaugeEquipmentController::class);
Route::get('gauge_equipment/preview/{plan_id}/{sub_stage_id}',[IdentificationOfGaugeEquipmentController::class,'preview'])->name('gauge_equipment_preview');
Route::resource('process_flow_diagram',ProcessFlowDiagramController::class);
Route::get('process_flow_diagram/preview/{plan_id}/{sub_stage_id}',[ProcessFlowDiagramController::class,'preview'])->name('process_flow_diagram_preview');
Route::resource('process_failure_analysis',ProcessFailureAnalysisController::class);
Route::get('process_failure_analysis/preview/{plan_id}/{sub_stage_id}',[ProcessFailureAnalysisController::class,'preview'])->name('process_failure_analysis_preview');
Route::resource('tool_design',ToolDesignController::class);
Route::resource('inspection_report',InspectionReportController::class);
Route::resource('work_instructions',WorkInstructionController::class);
Route::get('work_instructions/preview/{plan_id}/{sub_stage_id}',[WorkInstructionController::class,'preview'])->name('work_instructions_preview');
Route::resource('ptr_signoff',PtrSignoffController::class);
Route::get('ptr_signoff/preview/{plan_id}/{sub_stage_id}',[PtrSignoffController::class,'preview'])->name('ptr_signoff_preview');
Route::resource('prelaunch_control_plan',PreLaunchControlPlanController::class);
Route::get('prelaunch_control_plan/preview/{plan_id}/{sub_stage_id}',[PreLaunchControlPlanController::class,'preview'])->name('prelaunch_control_plan_preview');
Route::resource('proto_control_plan',ProtoControlPlanController::class);
Route::get('proto_control_plan/preview/{plan_id}/{sub_stage_id}',[ProtoControlPlanController::class,'preview'])->name('proto_control_plan_preview');
Route::resource('production_control_plan',ProductionControlPlanController::class);
Route::get('production_control_plan/preview/{plan_id}/{sub_stage_id}',[ProductionControlPlanController::class,'preview'])->name('production_control_plan_preview');
Route::resource('management_review',ManagementReviewController::class);
Route::get('management_review/preview/{plan_id}/{sub_stage_id}',[ManagementReviewController::class,'preview'])->name('management_review_preview');
Route::resource('subcontract_process',SubcontractProcessController::class);
Route::get('subcontract_process/preview/{plan_id}/{sub_stage_id}',[SubcontractProcessController::class,'preview'])->name('subcontract_process_preview');
Route::resource('gauge_design_and_development',GaugeDesignAndDevelopementController::class);
Route::get('gauge_design_and_development/preview/{plan_id}/{sub_stage_id}',[GaugeDesignAndDevelopementController::class,'preview'])->name('gauge_design_and_development_preview');
Route::resource('msa_study',MsaStudyController::class);
Route::get('msa_study/preview/{plan_id}/{sub_stage_id}',[MsaStudyController::class,'preview'])->name('msa_study_preview');
Route::resource('spc_study',SpcStudyController::class);
Route::get('spc_study/preview/{plan_id}/{sub_stage_id}',[SpcStudyController::class,'preview'])->name('spc_study_preview');
Route::resource('experience_sharing',ExperienceSharingController::class);
Route::get('experience_sharing/preview/{plan_id}/{sub_stage_id}',[ExperienceSharingController::class,'preview'])->name('experience_sharing_preview');
Route::resource('sample_submission',SampleSubmissionController::class);
Route::get('sample_submission/preview/{plan_id}/{sub_stage_id}',[SampleSubmissionController::class,'preview'])->name('sample_submission_preview');
Route::resource('sample_approval',SirApprovalController::class);
Route::get('sample_approval/preview/{plan_id}/{sub_stage_id}',[SirApprovalController::class,'preview'])->name('sample_approval_preview');
Route::resource('pilot_lot',PilotLotController::class);
Route::get('pilot_lot/preview/{plan_id}/{sub_stage_id}',[PilotLotController::class,'preview'])->name('pilot_lot_preview');
Route::resource('packing_specification',PackingSpecificationPreparationController::class);
Route::get('packing_specification/preview/{plan_id}/{sub_stage_id}',[PackingSpecificationPreparationController::class,'preview'])->name('packing_specification_preview');
Route::resource('ppap_preparation',PpapPreparationController::class);
Route::get('ppap_preparation/preview/{plan_id}/{sub_stage_id}',[PpapPreparationController::class,'preview'])->name('ppap_preparation_preview');
Route::resource('process_design_goal',ProcessDesignGoalController::class);
Route::get('process_design_goal/preview/{plan_id}/{sub_stage_id}',[ProcessDesignGoalController::class,'preview'])->name('process_design_goal_preview');
Route::resource('customer_approval_of_ppap',CustomerApprovalOfPpapController::class);
Route::get('customer_approval_of_ppap/preview/{plan_id}/{sub_stage_id}',[CustomerApprovalOfPpapController::class,'preview'])->name('customer_approval_of_ppap_preview');
Route::resource('safe_launch',SafeLaunchController::class);
Route::get('safe_launch/preview/{plan_id}/{sub_stage_id}',[SafeLaunchController::class,'preview'])->name('safe_launch_preview');


});
