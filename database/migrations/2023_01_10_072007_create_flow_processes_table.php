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
        Schema::create('flow_processes', function (Blueprint $table) {
            $table->id();
            $table->integer('process_flow_diagram_id');
            $table->string('process');
            $table->string('process_name');
            $table->string('incoming_source_of_variation');
            $table->string('product_characteristics');
            $table->string('process_characteristics');
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
        Schema::dropIfExists('flow_processes');
    }
};
