<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Class Post
 *
 * Represents a Post entity in the application.
 *
 * This class extends Laravel's Eloquent Model and uses the HasFactory trait,
 * enabling it to interact with the database and utilize factories for testing.
 * It represents a blog post which can belong to a category and have multiple tags.
 *
 * @property int $id The unique identifier for the post.
 * @property string $title The title of the post.
 * @property string $slug A slug for the post for URL-friendly identifiers.
 * @property string $content The content/body of the post.
 * @property int $category_id The foreign key for the associated category.
 * @property string|null $image The file path of the post's image.
 * @property-read Category $category The category this post belongs to.
 * @property-read \Illuminate\Database\Eloquent\Collection|Tag[] $tags The tags associated with the post.
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'draft' => 'boolean',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'image',
        'draft'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * Get the category that the post belongs to.
     *
     * @return BelongsTo
     *   The relationship query builder for the category.
     */
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    /**
     * The tags that belong to the post.
     *
     * @return BelongsToMany
     *   The relationship query builder for tags.
     */
    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the URL of the post's image.
     *
     * @return string
     *   The URL of the image if it exists, otherwise an empty string.
     */
    public function imageUrl(): string {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }
}
