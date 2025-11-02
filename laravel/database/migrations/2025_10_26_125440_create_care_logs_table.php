<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('care_logs', function (Blueprint $table) {  // ← Harus 'care_logs' bukan 'pets'!
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->string('activity_type');
            $table->date('activity_date');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('care_logs');  // ← Harus 'care_logs' bukan 'pets'!
    }
};