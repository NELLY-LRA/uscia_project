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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
    $table->string('last_name');
    $table->string('first_name')->nullable();
    $table->string('phone')->nullable();
    $table->string('grade')->nullable();
    $table->enum('gender', ['male', 'female'])->nullable();
    $table->date('date_of_birth')->nullable();
    $table->string('address')->nullable();
    $table->string('email')->unique();
    $table->string('nationality')->nullable();
    $table->string('educational_level')->nullable();
    $table->string('blood_group')->nullable();
    $table->string('occupation')->nullable();
    $table->string('passport')->nullable();
    $table->string('cni_number')->nullable();
    $table->string('organization')->nullable();
    $table->string('citizenship_id')->nullable();
    $table->string('nearest_police_station')->nullable();
    $table->string('cv')->nullable();
    $table->string('letter_of_recommendation')->nullable();
    $table->string('criminal_record')->nullable();
    $table->boolean('has_been_convicted')->default(false)->nullable();
    $table->boolean('is_pastor')->default(false)->nullable();
    $table->string('role')->default('member'); // 'super_admin', 'national_admin', etc.
    $table->string('password');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
