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
    Schema::create('owns', function (Blueprint $table) {
        $table->id();
        $table->foreignId('companies_id')->constrained('companies')->onDelete('cascade');
        $table->foreignId('solar_panel_id')->nullable()->constrained('solar_panel')->onDelete('cascade');
        $table->foreignId('inverter_id')->nullable()->constrained('inverter')->onDelete('cascade');
        $table->foreignId('battery_id')->nullable()->constrained('battery')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owns');
    }
};
