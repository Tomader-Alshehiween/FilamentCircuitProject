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
        // Create referenced tables first
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->string('service_provider')->unique();
            $table->timestamps();
        });
        Schema::create('circuit_types', function (Blueprint $table) {
            $table->id();
            $table->string('circuit_type')->unique();
            $table->timestamps();
        });
        Schema::create('circuit_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('circuit_status')->unique();
            $table->timestamps();
        });
        Schema::create('entity_types', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type')->unique();
            $table->timestamps();
        });
        Schema::create('entity_name', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name')->unique();
            $table->foreignId('entity_type_id')->constrained('entity_types')->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('circuit_number');
            $table->string('speed');
            $table->foreignId('service_provider_id')->constrained('service_providers')->cascadeOnDelete();
            $table->foreignId('circuit_type_id')->constrained('circuit_types')->cascadeOnDelete();
            $table->foreignId('entity_name_id')->constrained('entity_name')->cascadeOnDelete();
            $table->foreignId('circuit_status_id')->constrained('circuit_statuses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circuits');
        Schema::dropIfExists('entity_name');
        Schema::dropIfExists('circuit_statuses');
        Schema::dropIfExists('entity_types');
        Schema::dropIfExists('circuit_types');
        Schema::dropIfExists('service_providers');
    }
};
