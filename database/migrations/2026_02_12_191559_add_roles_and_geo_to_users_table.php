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
        Schema::table('users', function (Blueprint $table) {
            // Ajouter le rôle
            $table->enum('role', ['super_admin', 'national_admin', 'regional_admin'])
                  ->default('regional_admin')
                  ->after('email');

            // Ajouter les clés étrangères
            $table->foreignId('country_id')
                  ->nullable()
                  ->constrained()
                  ->after('role');

            $table->foreignId('region_id')
                  ->nullable()
                  ->constrained()
                  ->after('country_id');

            // Ajouter le statut
            $table->boolean('is_active')
                  ->default(true)
                  ->after('region_id');

            // Qui a créé cet utilisateur
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->after('is_active');

            // Dernière connexion
            $table->timestamp('last_login_at')
                  ->nullable()
                  ->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'country_id',
                'region_id',
                'is_active',
                'created_by',
                'last_login_at'
            ]);
        });
    }
};
