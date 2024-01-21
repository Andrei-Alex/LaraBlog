<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 *
 * Represents a category for blog posts.
 *
 * This model is used to represent a category in the system. Each category can have multiple posts.
 * It uses Laravel's Eloquent ORM for data handling.
 */
class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name'];

    /**
     * Get the posts associated with the category.
     *
     * This method defines a one-to-many relationship between Category and Post models.
     * It allows for easy retrieval of all posts under a specific category.
     *
     * @return HasMany
     *   The relationship query builder for posts.
     */
    public function posts() : HasMany {
        return $this->hasMany(Post::class);
    }
}
