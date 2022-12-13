<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apqp_timing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('apqp_timing_plan_number')->unique();
            $table->integer('part_number_id');
            $table->string('format_number',255);
            $table->string('issuance_number',255);            
            $table->date('format_date');            
            $table->date('issuance_date');            
            $table->string('supplier',255)->default('VENKATESWARA STEELS & SPRINGS INDIA PVT LTD');            
            $table->integer('customer_id');            
            // $table->string('customer_milestone',255);
            // $table->string('status',32)->default('PENDING');
            // $table->string('responsibility',255);
            // $table->date('plan_start_date');
            // $table->date('plan_complete_date');
            // $table->date('actual_start_date');
            // $table->date('actual_complete_date');
            $table->text('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('a_p_q_p_timing_plans');
    }
};
