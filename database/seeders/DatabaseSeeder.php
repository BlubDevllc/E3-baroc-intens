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
            'name' => 'Admin User',
            'email' => 'admin@barroc.nl',
            'password' => Hash::make('Password123!'),
        ]);

        User::factory()->create([
            'name' => 'Sales Medewerker',
            'email' => 'sales@barroc.nl',
            'password' => Hash::make('Password123!'),
        ]);

        User::factory()->create([
            'name' => 'Inkoop Medewerker',
            'email' => 'inkoop@barroc.nl',
            'password' => Hash::make('Password123!'),
        ]);

        User::factory()->create([
            'name' => 'Finance Medewerker',
            'email' => 'finance@barroc.nl',
            'password' => Hash::make('Password123!'),
        ]);

        User::factory()->create([
            'name' => 'Hoofd Koffie Afdeling',
            'email' => 'koffie@barroc.nl',
            'password' => Hash::make('Password123!'),
        ]);
    }
}
