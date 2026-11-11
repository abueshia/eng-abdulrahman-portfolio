<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programme_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email');
            $table->string('phone');
            $table->string('note')->nullable();

            $table->unsignedBigInteger('programme_id');
            $table->bigInteger('adults');
            $table->bigInteger('children');
            $table->bigInteger('infants');
            $table->bigInteger('persons');
            $table->date('check_in');
            $table->double('price_before_discount');
            $table->double('discount');
            $table->string('discount_type');
            $table->double('discount_value');
            $table->double('price_after_discount');
            $table->double('tax');
            $table->double('tax_value');
            $table->double('total');
            $table->string('payment_method');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->unsignedBigInteger('user_id')->default(7);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('programme_id')->references('id')->on('programmes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_bookings');
    }
};
