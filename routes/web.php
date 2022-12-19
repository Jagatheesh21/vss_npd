<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartNumberController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\SubStageController;
use App\Http\Controllers\APQPTimingPlanController;
use App\Http\Controllers\APQPPlanActivityController;


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
Route::get('test_mail', [HomeController::class, 'test_email'])->name('test_mail');
Route::get('customer/export/excel', [CustomerController::class, 'export_excel'])->name('customer.export_excel');
Route::get('customer/export/pdf', [CustomerController::class, 'export_pdf'])->name('customer.export_pdf');
Route::resource('customer',CustomerController::class);
Route::resource('part_number',PartNumberController::class);
Route::resource('stage',StageController::class);
Route::resource('sub_stage',SubStageController::class);
Route::get('apqp_timing_plan/plan_scheduler',[APQPTimingPlanController::class,'plan_scheduler'])->name('plan_scheduler');
Route::post('apqp_timing_plan/scheduler_update',[APQPTimingPlanController::class,'scheduler_update'])->name('scheduler_update');
Route::post('apqp_timing_plan/plans',[APQPTimingPlanController::class,'getPlans'])->name('plans');
Route::post('apqp_timing_plan/plan_activities',[APQPTimingPlanController::class,'getPlanActivities'])->name('plan_activities');
Route::resource('apqp_timing_plan',APQPTimingPlanController::class);

