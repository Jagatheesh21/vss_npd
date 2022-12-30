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
        Schema::create('product_information_data', function (Blueprint $table) {
            $table->id();
            $table->integer('apqp_timing_plan_id');
            $table->integer('stage_id');
            $table->integer('sub_stage_id');
            $table->integer('customer_id');
            $table->string('application');
            $table->string('product_description');
            $table->string('revision_number');
            $table->enum('customer_po_reference',['YES','NO'])->default('YES');
            $table->decimal('price',16,2)->default(0.00);
            $table->date('delivery_commencement_date')->nullable();
            $table->string('brought_out_parts')->nullable();
            $table->string('sub_contract_process')->nullable();
            $table->string('preliminary_process_flow')->nullable();
            $table->enum('special_characteristics',['YES','NO'])->default('YES');
            $table->enum('cpk_ppk_requirements',['YES','NO'])->default('YES');
            $table->enum('customer_requirements',['YES','NO'])->default('YES');
            $table->enum('list_of_new_equipments',['YES','NO'])->default('YES');
            $table->enum('part_approval_requirement',['YES','NO'])->default('YES');
            $table->enum('proto_type_build_requirement',['YES','NO'])->default('YES');
            $table->enum('labeling_requirement',['YES','NO'])->default('YES');
            $table->enum('product_traceability_requirement',['YES','NO'])->default('YES');
            $table->enum('other_requirement',['YES','NO'])->default('YES');
            $table->enum('experience_of_previous_development',['YES','NO'])->default('YES');
            $table->integer('prepared_by');
            $table->date('prepared_at');
            $table->integer('checked_by')->nullble();
            $table->date('checked_at')->nullable();
            $table->integer('approved_by')->nullable();
            $table->date('approved_at')->nullable();
            $table->integer('checked_status')->default(0);
            $table->integer('approved_status')->default(0);
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
        Schema::dropIfExists('product_information_data');
    }
};
