<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->unsignedBigInteger('initial_lab_id');
            $table->foreign('initial_lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->unsignedBigInteger('final_lab_id');
            $table->foreign('final_lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->string('allocated_to');
            $table->date('issue_date');
            $table->date('receive_date');
            $table->enum('is_active', [0, 1])->default(1);
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
        Schema::dropIfExists('inventory_histories');
    }
}
