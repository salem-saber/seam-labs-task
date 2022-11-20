<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('TAKEAWAY');
            $table->string('customer_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->float('delivery_fees')->nullable();
            $table->integer('table_number')->nullable();
            $table->float('service_charge')->nullable();
            $table->string('waiter_name')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
