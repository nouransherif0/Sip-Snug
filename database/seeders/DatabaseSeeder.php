<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Nouran',
            'email' => 'admin@sipandsnug.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'admin',
        ]);

        $this->call([
            RealDataSeeder::class,
<<<<<<< HEAD
=======
            StoreLocationSeeder::class,
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64
        ]);
    }
}
