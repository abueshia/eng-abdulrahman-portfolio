<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('cards', function (Blueprint $table) {
    //         $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    //     });
    // }
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            // أضف العمود category_id
            $table->unsignedBigInteger('category_id')->nullable(); // إذا كنت تريد السماح بالقيم الفارغة

            // ثم أضف الـ foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            // حذف الـ foreign key
            $table->dropForeign(['category_id']);

            // حذف العمود category_id
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */

};
