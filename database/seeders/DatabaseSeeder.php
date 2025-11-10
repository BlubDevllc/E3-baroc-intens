<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Testgebruikers voor verschillende afdelingen
        // Wachtwoord voor alle testgebruikers: Password123!
        
        User::factory()->create([
            'name' => 'Management User',
            'email' => 'management@barroc.nl',
            'password' => Hash::make('Password123!'),
            'role' => 'management',
            'department' => 'Management',
        ]);

        User::factory()->create([
            'name' => 'Sales Medewerker',
            'email' => 'sales@barroc.nl',
            'password' => Hash::make('Password123!'),
            'role' => 'sales',
            'department' => 'Sales',
        ]);

        User::factory()->create([
            'name' => 'Inkoop Medewerker',
            'email' => 'inkoop@barroc.nl',
            'password' => Hash::make('Password123!'),
            'role' => 'inkoop',
            'department' => 'Inkoop',
        ]);

        User::factory()->create([
            'name' => 'Financieel Medewerker',
            'email' => 'financieel@barroc.nl',
            'password' => Hash::make('Password123!'),
            'role' => 'finance',
            'department' => 'Financieel',
        ]);

        User::factory()->create([
            'name' => 'Onderhoud Medewerker',
            'email' => 'onderhoud@barroc.nl',
            'password' => Hash::make('Password123!'),
            'role' => 'onderhoud',
            'department' => 'Onderhoud',
        ]);

        User::factory()->create([
            'name' => 'Planning Medewerker',
            'email' => 'planning@barroc.nl',
            'password' => Hash::make('Password123!'),
            'role' => 'planning',
            'department' => 'Planning',
        ]);
    }
}
