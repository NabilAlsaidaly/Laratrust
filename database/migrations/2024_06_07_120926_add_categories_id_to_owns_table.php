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
        Schema::table('owns', function (Blueprint $table) {
            $table->foreignId('categories_id')->nullable()->constrained('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owns', function (Blueprint $table) {
            $table->dropForeign(['categories_id']);
        $table->dropColumn('categories_id');
        });
    }
};
