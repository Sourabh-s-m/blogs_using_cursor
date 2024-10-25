<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('role', 'admin')->first();
        $categories = Category::all();

        $blogs = [
            [
                'title' => 'The Future of AI',
                'description' => 'Artificial Intelligence is rapidly evolving...',
                'category_id' => $categories->where('name', 'Technology')->first()?->id,
            ],
            [
                'title' => 'Top 10 Travel Destinations for 2023',
                'description' => 'Discover the most exciting places to visit this year...',
                'category_id' => $categories->where('name', 'Travel')->first()->id,
            ],
            [
                'title' => 'Healthy Eating Habits',
                'description' => 'Learn how to maintain a balanced diet...',
                'category_id' => $categories->where('name', 'Food')->first()->id,
            ],
            [
                'title' => 'Mindfulness and Well-being',
                'description' => 'Explore techniques for improving your mental health...',
                'category_id' => $categories->where('name', 'Lifestyle')->first()->id,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(
                ['title' => $blog['title']], // criteria for findinnpm install jqueryg existing record
                [
                    'description' => $blog['description'],
                    'user_id' => $user->id,
                    'category_id' => $blog['category_id'],
                ]
            );
        }
    }
}
