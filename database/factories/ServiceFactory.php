<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    public function definition(): array
    {
        $services = [

            [
                'title' => 'Les Matematika SMA',
                'category' => 'Les Privat',
                'price' => 75000,
                'image' => 'https://picsum.photos/600/400?random=1',
            ],

            [
                'title' => 'Tutor Bahasa Inggris Anak',
                'category' => 'Les Privat',
                'price' => 90000,
                'image' => 'https://picsum.photos/600/400?random=2',
            ],

            [
                'title' => 'Persiapan UTBK Intensif',
                'category' => 'Les Privat',
                'price' => 150000,
                'image' => 'https://picsum.photos/600/400?random=3',
            ],

            [
                'title' => 'Jasa Desain Logo UMKM',
                'category' => 'Desain',
                'price' => 250000,
                'image' => 'https://picsum.photos/600/400?random=4',
            ],

            [
                'title' => 'Desain Feed Instagram',
                'category' => 'Desain',
                'price' => 180000,
                'image' => 'https://picsum.photos/600/400?random=5',
            ],

            [
                'title' => 'UI UX Mobile App',
                'category' => 'Desain',
                'price' => 850000,
                'image' => 'https://picsum.photos/600/400?random=6',
            ],

            [
                'title' => 'Pembuatan Website Laravel',
                'category' => 'Programming',
                'price' => 2500000,
                'image' => 'https://picsum.photos/600/400?random=7',
            ],

            [
                'title' => 'Mobile App Flutter',
                'category' => 'Programming',
                'price' => 3500000,
                'image' => 'https://picsum.photos/600/400?random=8',
            ],

            [
                'title' => 'Jasa API Development',
                'category' => 'Programming',
                'price' => 1200000,
                'image' => 'https://picsum.photos/600/400?random=9',
            ],

            [
                'title' => 'Foto Produk Profesional',
                'category' => 'Fotografi',
                'price' => 450000,
                'image' => 'https://picsum.photos/600/400?random=10',
            ],

            [
                'title' => 'Jasa Foto Wisuda',
                'category' => 'Fotografi',
                'price' => 600000,
                'image' => 'https://picsum.photos/600/400?random=11',
            ],

            [
                'title' => 'Video Editing TikTok',
                'category' => 'Video Editing',
                'price' => 300000,
                'image' => 'https://picsum.photos/600/400?random=12',
            ],

            [
                'title' => 'Editing Video YouTube',
                'category' => 'Video Editing',
                'price' => 750000,
                'image' => 'https://picsum.photos/600/400?random=13',
            ],

            [
                'title' => 'Social Media Management',
                'category' => 'Marketing',
                'price' => 950000,
                'image' => 'https://picsum.photos/600/400?random=14',
            ],

            [
                'title' => 'Jasa SEO Website',
                'category' => 'Marketing',
                'price' => 1500000,
                'image' => 'https://picsum.photos/600/400?random=15',
            ],

        ];

        $service = fake()->randomElement($services);

        return [
            'title' => $service['title'],
            'slug' => Str::slug($service['title'] . '-' . fake()->unique()->numberBetween(1, 99999)),
            'description' => fake()->randomElement([
                'Pelayanan profesional dan berkualitas untuk kebutuhan Anda.',
                'Berpengalaman menangani berbagai klien dengan hasil memuaskan.',
                'Cocok untuk pelajar, UMKM, maupun kebutuhan bisnis profesional.',
                'Dikerjakan secara cepat, rapi, dan sesuai kebutuhan pelanggan.',
                'Membantu meningkatkan kualitas bisnis dan produktivitas Anda.',
            ]),
            'price' => $service['price'],
            'category' => $service['category'],
            'image' => $service['image'],
            'rating' => fake()->randomFloat(1, 4, 5),
            'total_orders' => fake()->numberBetween(10, 500),
            'status' => fake()->randomElement(['published', 'published', 'published', 'draft']),
        ];
    }
}
