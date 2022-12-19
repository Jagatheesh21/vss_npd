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
            $table->string('revision_number',255);
            $table->string('issuance_number',255);            
            $table->date('revision_date');            
            $table->date('issuance_date');            
            $table->string('supplier',255)->default('VENKATESWARA STEELS & SPRINGS INDIA PVT LTD');            
            $table->integer('customer_id');            
            $table->integer('status_id')->default(1);
            $table->integer('current_stage_id')->nullable();
            $table->integer('current_sub_stage_id')->nullable();
            $table->enum('approval_status',['PENDING','APPROVED','REJECTED'])->default('PENDING');
            $table->integer('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->text('remarks')->nullable();
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
