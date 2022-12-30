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
        Schema::create('manufacturing_feasibility_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('apqp_timing_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->string('grid_notes');
            $table->string('pfd_no');
            $table->string('parameters_per_drawing');
            $table->string('specification_per_drawing');
            $table->string('past_trouble');
            $table->string('initial_sample_layout_inspection');
            $table->string('mass_production');
            $table->string('feasibility_confirmation');
            $table->string('remarks');
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
        Schema::dropIfExists('manufacturing_feasibility_reviews');
    }
};
