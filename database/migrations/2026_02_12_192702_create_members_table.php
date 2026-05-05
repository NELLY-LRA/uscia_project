<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // === INFORMATIONS PERSONNELLES ===
            $table->string('last_name');
            $table->string('first_name')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group')->nullable(); // A+, O-, etc.
            $table->string('nationality')->nullable();

            // === CONTACT ===
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('nearest_police_station')->nullable();

            // === IDENTITÉ ===
            $table->string('passport_number')->nullable();
            $table->string('cni_number')->nullable();
            $table->string('citizenship_id')->nullable();

            // === PROFESSIONNEL ===
            $table->string('occupation')->nullable();
            $table->string('educational_level')->nullable();
            $table->string('organization')->nullable();

            // === USCIA ===
            $table->string('uscia_number')->unique();
            $table->string('grade_name'); // Grade en texte
            $table->foreignId('grade_id')->nullable()->constrained();
            $table->date('membership_date')->nullable();

            // === LOCALISATION USCIA ===
            $table->foreignId('country_id')->constrained();
            $table->foreignId('region_id')->constrained();

            // === DOCUMENTS ===
            $table->string('cv_path')->nullable();
            $table->string('letter_of_recommendation_path')->nullable();
            $table->string('criminal_record_path')->nullable();
            $table->string('photo_path')->nullable();

            // === JURIDIQUE ===
            $table->boolean('has_been_convicted')->default(false);
            $table->text('conviction_details')->nullable();

            // === RELIGIEUX ===
            $table->boolean('is_pastor')->default(false);
            $table->string('religious_denomination')->nullable();

            // === TRACABILITÉ ===
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');

            $table->timestamps();
            $table->softDeletes();

            // Index pour recherche rapide
            $table->index(['last_name', 'first_name']);
            $table->index('uscia_number');
            $table->index('country_id');
            $table->index('region_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
};
