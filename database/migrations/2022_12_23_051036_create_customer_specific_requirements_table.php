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
        Schema::create('customer_specific_requirements', function (Blueprint $table) {
            $table->id();
            $table->integer('apqp_timing_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->integer('part_number_id');
            $table->string('revision_number');
            $table->date('revision_date');
            $table->integer('customer_id');
            $table->string('application');
            $table->string('manufacturing_requirements');
            $table->string('handling_requirements');
            $table->string('marking_requirements');
            $table->string('packing_preservation');
            $table->string('delivery_requirements');
            $table->string('document_requirements');
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
        Schema::dropIfExists('customer_specific_requirements');
    }
};
