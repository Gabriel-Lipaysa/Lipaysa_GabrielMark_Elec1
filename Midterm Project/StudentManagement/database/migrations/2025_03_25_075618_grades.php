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
        Schema::create('grades', function (Blueprint $table){
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->decimal('grade');
            $table->enum('remarks',['Subject Taken', 'Dropped', 'Fail', 'Passed'])->default('Subject Taken');
            $table->timestamp('graded_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
