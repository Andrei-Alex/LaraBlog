<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Factory for the Post model.
 *
 * This factory is used to generate fake data for the Post model. It is particularly
 * useful during development and testing to create realistic content without manual input.
 * This factory extends Laravel's base Factory class, specifying the Post model as its target.
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * This property must be defined and should match the model that this factory
     * is meant to generate fake data for.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * This method returns an array of default attribute values for the Post model.
     * It utilizes Faker to generate dynamic and realistic data, such as titles and content.
     * It also handles the conditional logic for assigning images from a predefined storage
     * directory or generating a placeholder image URL if the directory is empty.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $directory = storage_path('app/public/blog');
        $files = File::files($directory);

        if (count($files) > 0) {
            $imageFile = $files[rand(0, count($files) - 1)];
            $image = 'blog/' . $imageFile->getFilename();
        } else {
            $image = $this->faker->imageUrl(640, 480, 'post');
        }

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(5, true),
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
            'image' => $image,
        ];
    }
}
