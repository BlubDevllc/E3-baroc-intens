<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Add Role and Department to Users Table
 * 
 * Voegt rol en afdeling kolommen toe aan de users tabel voor
 * role-based access control en afdelingsindeling.
 * 
 * Beschikbare rollen: management, sales, inkoop, finance, onderhoud, planning
 * Beschikbare afdelingen: Management, Sales, Inkoop, Financieel, Onderhoud, Planning
 */
return new class extends Migration
{
    /**
     * Voer de migraties uit.
     * 
     * Voegt role en department kolommen toe aan users tabel.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rol van de gebruiker (verplicht, default: employee)
            $table->string('role')->default('employee')->after('email');
            
            // Afdeling van de gebruiker (optioneel)
            $table->string('department')->nullable()->after('role');
        });
    }

    /**
     * Draai de migraties terug.
     * 
     * Verwijdert role en department kolommen van users tabel.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'department']);
        });
    }
};
