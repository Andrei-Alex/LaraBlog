<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence;
        $directory = storage_path('app/public/blog');
        $files = File::files($directory);
        $imageFile = $files[rand(0, count($files) - 1)];

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(asText: true),
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
            'image' => 'blog/' . $imageFile->getFilename(),
        ];
    }
}
