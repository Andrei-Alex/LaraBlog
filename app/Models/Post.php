<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Post model representing a blog post in the application.
 *
 * This model handles the data representation of a blog post, which includes
 * attributes like title, content, category, and associated tags. It leverages
 * Laravel's Eloquent ORM for database interaction, including relationships
 * with Category and Tag models. It supports soft deletes, allowing posts to be
 * restored after deletion.
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'draft' => 'boolean',
    ];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'image',
        'draft',
        'user_id',
    ];

    /**
     * Category relationship, a post belongs to a category.
     *
     * @return BelongsTo The relationship instance.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Tags relationship, a post can have many tags.
     *
     * @return BelongsToMany The relationship instance.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * User relationship, a post belongs to a user.
     *
     * @return BelongsTo The relationship instance.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieves the URL of the post's image.
     *
     * @return string The URL if the image exists, otherwise an empty string.
     */
    public function imageUrl(): string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }

    /**
     * Scope a query to filter posts by user ID.
     *
     * @param Builder $query The query builder instance.
     * @param mixed $userId The ID of the user.
     * @return Builder The modified query builder instance.
     */
    public function scopeFilterByUser(Builder $query, mixed $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to order posts by a given field and direction.
     *
     * @param Builder $query The query builder instance.
     * @param string $field The field to order by.
     * @param string $direction The direction of sorting (asc or desc).
     * @return Builder The modified query builder instance.
     */
    public function scopeOrderByField(Builder $query, string $field, string $direction = 'asc'): Builder
    {
        return $query->orderBy($field, $direction);
    }
}
