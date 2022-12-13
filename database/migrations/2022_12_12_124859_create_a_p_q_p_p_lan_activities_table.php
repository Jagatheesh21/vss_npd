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
            $table->integer('apqp_timimg_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->integer('responsibility');
            $table->date('plan_start_date');
            $table->date('plan_end_date');
            $table->date('actual_start_date');
            $table->date('actual_end_date');
            $table->integer('status_id');
            $table->text('remarks');
            $table->integer('aging')->default(0);
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
