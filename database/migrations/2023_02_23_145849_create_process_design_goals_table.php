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
        Schema::create('process_design_goals', function (Blueprint $table) {
            $table->id();
            $table->integer('apqp_timing_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->integer('part_number_id');
            $table->string('revision_number');
            $table->date('revision_date');
            $table->integer('customer_id');
            $table->string('application');
            $table->string('product_description');
            $table->string('target_cost');
            $table->string('target_quality');
            $table->string('target_output');
            $table->string('target_cpk');
            $table->string('actual_cost');
            $table->string('actual_quality');
            $table->string('actual_output');
            $table->string('actual_cpk');
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
        Schema::dropIfExists('process_design_goals');
    }
};
