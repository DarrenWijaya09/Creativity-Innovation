<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // FORUM CATEGORIES
        $this->call([
            ForumCategorySeeder::class,
        ]);

        // USER BIASA
        User::factory(50)->create();

        // SELLER
        User::factory(20)
            ->create([
                'role' => 1,
            ])
            ->each(function ($user) {

                $provider = Provider::factory()->create([
                    'user_id' => $user->id,
                ]);

                Service::factory(
                    rand(3, 8)
                )->create([
                            'provider_id' => $provider->id,
                        ]);

            });
    }
}
