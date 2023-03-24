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
Route::get('change-password', [ChangePasswordController::class,'index'])->name('change_password');
Route::post('change-password', [ChangePasswordController::class,'store'])->name('change.password');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('test_mail', [HomeController::class, 'test_mail'])->name('test_mail');
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
Route::get('apqp_timing_plan/export',[APQPTimingPlanController::class,'export'])->name('timing_plan.export');
Route::resource('apqp_timing_plan',APQPTimingPlanController::class);
Route::get('escalation_activity',[APQPPLanActivityController::class,'escalation_activity'])->name('escalation_activity');
Route::get('escalation_export',[APQPPLanActivityController::class,'escalation_export'])->name('escalation_export');
Route::resource('activity',APQPPLanActivityController::class);
Route::post('enquiry_register/save_register',[EnquiryRegisterController::class,'save_register'])->name('save_register');
Route::resource('enquiry_register',EnquiryRegisterController::class);
Route::resource('product_information_data',ProductInformationDataController::class);
Route::resource('mfr',ManufacturingFeasibilityReviewController::class);
Route::resource('risk_analysis',RiskAnalysisController::class);
Route::resource('quote_preparation',QuotePrepartionController::class);
Route::resource('customer_requiements',CustomerSpecificRequirementController::class);
Route::resource('special_characteristics',IdentificationOfSpecialCharacteristicController::class);
Route::resource('gauge_equipment',IdentificationOfGaugeEquipmentController::class);
Route::resource('process_flow_diagram',ProcessFlowDiagramController::class);
Route::resource('process_failure_analysis',ProcessFailureAnalysisController::class);
Route::resource('tool_design',ToolDesignController::class);
Route::resource('inspection_report',InspectionReportController::class);
Route::resource('work_instructions',WorkInstructionController::class);
Route::resource('ptr_signoff',PtrSignoffController::class);
Route::resource('prelaunch_control_plan',PreLaunchControlPlanController::class);
Route::resource('proto_control_plan',ProtoControlPlanController::class);
Route::resource('production_control_plan',ProductionControlPlanController::class);
Route::resource('management_review',ManagementReviewController::class);
Route::resource('subcontract_process',SubcontractProcessController::class);
Route::resource('gauge_design_and_development',GaugeDesignAndDevelopementController::class);
Route::resource('msa_study',MsaStudyController::class);
Route::resource('spc_study',SpcStudyController::class);
Route::resource('experience_sharing',ExperienceSharingController::class);
Route::resource('sample_submission',SampleSubmissionController::class);
Route::resource('pilot_lot',PilotLotController::class);
Route::resource('packing_specification',PackingSpecificationPreparationController::class);
Route::resource('ppap_preparation',PpapPreparationController::class);
Route::resource('process_design_goal',ProcessDesignGoalController::class);
Route::resource('customer_approval_of_ppap',CustomerApprovalOfPpapController::class);
Route::resource('safe_launch',SafeLaunchController::class);


