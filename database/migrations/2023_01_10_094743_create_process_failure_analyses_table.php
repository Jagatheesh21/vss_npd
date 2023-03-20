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
        Schema::create('process_failure_analyses', function (Blueprint $table) {
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
            $table->string('location');
            $table->string('core_team');
            $table->string('process_description');
            $table->string('process_requirements');
            $table->string('potential_failure_mode');
            $table->string('potential_effects_of_failure');
            $table->string('severity');
            $table->string('failure_class');
            $table->string('potential_causes');
            $table->string('control_prevention');
            $table->string('occurance');
            $table->string('detection');
            $table->string('rpn');
            $table->string('so');
            $table->string('sd');
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
        Schema::dropIfExists('process_failure_analyses');
    }
};
