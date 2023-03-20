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
        Schema::create('proto_control_plans', function (Blueprint $table) {
            $table->id();
            $table->string('control_plan_number');
            $table->string('key_contact');
            $table->string('control_plan_type');
            $table->string('document_number');
            $table->string('core_team');
            $table->string('model_reference');
            $table->date('supplier_plant_approval_date');
            $table->date('customer_engineer_approval_date');
            $table->date('other_approval_date');
            $table->string('material_specification_norms');
            $table->integer('apqp_timing_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->integer('part_number_id');
            $table->string('revision_number');
            $table->date('revision_date');
            $table->integer('customer_id');
            $table->string('application');
            $table->string('product_description');
            $table->string('process_seq_no');
            $table->string('tools_for_manufacturing');
            $table->string('s_no');
            $table->string('product');
            $table->string('material_grade');
            $table->string('special_character');
            $table->string('process_specification');
            $table->string('measurement_technique');
            $table->string('size');
            $table->string('frequency');
            $table->string('control_method');
            $table->string('responsiblity');
            $table->string('reaction_plan');
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
        Schema::dropIfExists('proto_control_plans');
    }
};
