<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = Category::create(['name' => 'General']);

        Faq::create([
            'question' => 'What is this site about?',
            'answer' => 'This site is a community for sharing sports knowledge.',
            'category_id' => $category->id,
        ]);

        Faq::create([
            'question' => 'How can I contact support?',
            'answer' => 'You can contact support via the Contact page.',
            'category_id' => $category->id,
        ]);
    }
}