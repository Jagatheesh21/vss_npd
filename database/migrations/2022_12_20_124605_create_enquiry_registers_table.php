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
        Schema::create('enquiry_registers', function (Blueprint $table) {
            $table->id();
            $table->integer('apqp_timing_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->date('received_date');
            $table->string('enquiry_type');
            $table->text('enquiry_document')->nullable();
            $table->text('escalation')->nullable();
            $table->enum('ern_sample',['YES','NO'])->default('NO');
            $table->enum('sir_sample',['YES','NO'])->default('NO');
            $table->enum('safe_launch_sample',['YES','NO'])->default('NO');
            $table->integer('prepared_by');
            $table->integer('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('enquiry_registers');
    }
};
