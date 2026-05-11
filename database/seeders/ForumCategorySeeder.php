<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ForumCategory;
use Illuminate\Support\Str;

class ForumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [

            [
                'name' => 'Web Development',
                'color' => 'blue',
                'icon' => 'fas fa-code',
            ],

            [
                'name' => 'Mobile Development',
                'color' => 'purple',
                'icon' => 'fas fa-mobile-alt',
            ],

            [
                'name' => 'UI/UX Design',
                'color' => 'pink',
                'icon' => 'fas fa-pen-nib',
            ],

            [
                'name' => 'AI & Machine Learning',
                'color' => 'emerald',
                'icon' => 'fas fa-robot',
            ],

            [
                'name' => 'DevOps & Cloud',
                'color' => 'orange',
                'icon' => 'fas fa-server',
            ],

            [
                'name' => 'Database',
                'color' => 'cyan',
                'icon' => 'fas fa-database',
            ],

            [
                'name' => 'Cyber Security',
                'color' => 'red',
                'icon' => 'fas fa-shield-alt',
            ],

            [
                'name' => 'Freelancing',
                'color' => 'amber',
                'icon' => 'fas fa-briefcase',
            ],

            [
                'name' => 'Career & Portfolio',
                'color' => 'indigo',
                'icon' => 'fas fa-user-tie',
            ],

        ];

        foreach ($categories as $category) {

            ForumCategory::updateOrCreate(
                [
                    'slug' => Str::slug($category['name']),
                ],
                [
                    'name' => $category['name'],
                    'color' => $category['color'],
                    'icon' => $category['icon'],
                    'is_active' => true,
                ]
            );

        }
    }
}
