<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Language;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $language = Language::where('is_default', true)->first();

        Blog::insert([
            [
                'id'               => 1,
                'title'            => 'Blog Title',
                'description'      => 'Blog Details',
                'image'            => 'blog.jpg',
                'slug'             => 'blog-title-1',
                'status'           => 1,
                'featured'         => 1,
                'language_id'      => $language->id,
                'meta_title'       => 'Blog Meta Title',
                'meta_description' => 'Blog Meta Description',
            ],
            [
                'id'               => 2,
                'title'            => 'Blog Title',
                'description'      => 'Blog Details',
                'image'            => 'blog.jpg',
                'slug'             => 'blog-title-2',
                'status'           => 1,
                'featured'         => 1,
                'language_id'      => $language->id,
                'meta_title'       => 'Blog Meta Title',
                'meta_description' => 'Blog Meta Description',
            ],
            [
                'id'               => 3,
                'title'            => 'Blog Title',
                'description'      => 'Blog Details',
                'image'            => 'blog.jpg',
                'slug'             => 'blog-title-3',
                'status'           => 1,
                'featured'         => 1,
                'language_id'      => $language->id,
                'meta_title'       => 'Blog Meta Title',
                'meta_description' => 'Blog Meta Description',
            ],
        ]);
    }
}
