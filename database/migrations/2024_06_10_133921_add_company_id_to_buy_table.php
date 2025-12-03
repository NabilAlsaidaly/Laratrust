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
            $table->foreignId('companies_id')->constrained('companies');
        });
    }

    public function down()
    {
        Schema::table('buy', function (Blueprint $table) {
            $table->dropForeign(['companies_id']);
            $table->dropColumn('companies_id');
        });
    }
};
