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
use App\Http\Controllers\CustomerSpecificRequirementController;
use App\Http\Controllers\IdentificationOfSpecialCharacteristicController;
use App\Http\Controllers\IdentificationOfGaugeEquipmentController;
use App\Http\Controllers\ProcessFlowDiagramController;
use App\Http\Controllers\ProcessFailureAnalysisController;
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
Route::resource('apqp_timing_plan',APQPTimingPlanController::class);
Route::resource('activity',APQPPLanActivityController::class);
Route::post('enquiry_register/save_register',[EnquiryRegisterController::class,'save_register'])->name('save_register');
Route::resource('enquiry_register',EnquiryRegisterController::class);
Route::resource('product_information_data',ProductInformationDataController::class);
Route::resource('mfr',ManufacturingFeasibilityReviewController::class);
Route::resource('risk_analysis',RiskAnalysisController::class);
Route::resource('customer_requiements',CustomerSpecificRequirementController::class);
Route::resource('special_characteristics',IdentificationOfSpecialCharacteristicController::class);
Route::resource('gauge_equipment',IdentificationOfGaugeEquipmentController::class);
Route::resource('process_flow_diagram',ProcessFlowDiagramController::class);
Route::resource('process_failure_analysis',ProcessFailureAnalysisController::class);



