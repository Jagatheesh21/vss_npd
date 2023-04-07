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
        Schema::create('apqp_plan_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('apqp_timing_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->integer('process_time')->nullable();
            $table->integer('responsibility')->nullable();
            $table->date('plan_start_date')->nullable();
            $table->date('plan_end_date')->nullable();
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->integer('status_id')->default(1);
            $table->text('remarks')->nullable();
            $table->enum('gyr_status',['G','Y','R','P'])->default('P');
            $table->integer('prepared_by');
            $table->integer('prepared_at');
            $table->integer('verified_by');
            $table->integer('verified_at')->nullable();
            $table->integer('approved_by');
            $table->integer('approved_at')->nullable();
            $table->integer('aging');
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
        Schema::dropIfExists('a_p_q_p_p_lan_activities');
    }
};
