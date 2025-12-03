<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


     public function up()
    {
        Schema::table('buy', function (Blueprint $table) {
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('buy', function (Blueprint $table) {
            // لحذف العلاقة (إن وجدت)
            $table->dropForeign(['categories_id']);

            // لحذف العمود
            $table->dropColumn('categories_id');
        });
    }
};
