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
        Schema::create('management_reviews', function (Blueprint $table) {
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
            $table->integer('meeting_id');
            $table->date('meeting_date');
            $table->string('meeting_attend_by');
            $table->string('points_discussed');
            $table->integer('responsibility');
            $table->date('target_date');
            $table->date('actual_date')->nullable();
            $table->string('delay_reason');
            $table->string('action_plan');
            $table->string('revisied_target_date');
            $table->string('review_comments');
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
        Schema::dropIfExists('management_reviews');
    }
};
