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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->enum('sex', ['Male', 'Female']);
            $table->date('dob');
            $table->string('phone');
            $table->string('address');
            $table->string('guardian_name');
            $table->string('guardian_phone');
            $table->enum('status', ['Active', 'Inactive', 'Graduated', 'Dropped']); // Fixed enum
            $table->string('email')->unique();
            $table->string('pwd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
