<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_receipt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quantity');
            $table->unsignedDecimal('value', 8, 2);

            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('medicine_id');
            $table->timestamps();

            $table->foreign('receipt_id')->references('id')->on('receipts');
            $table->foreign('medicine_id')->references('id')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_receipt');
    }
}
