<?php

namespace Database\Factories;

use App\Models\BuilderBlog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuilderBlog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

            return [
                'title' => 'Post Title',
                'text' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'tags' => '1',
                'image' => 'images/blog/1.jpeg',
                'time' => time(),
            ];
    }
}
