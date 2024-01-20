<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Post
 *
 * Represents a Post entity in the application.
 *
 * This class extends Laravel's Eloquent Model and uses the HasFactory trait,
 * enabling it to interact with the database and utilize factories for testing.
 *
 * Properties:
 *
 * @property string $title The title of the post.
 * @property string $slug A slug for the post for URL-friendly identifiers.
 * @property string $content The content/body of the post.
 *
 * Attributes:
 * @property array $fillable Attributes that are mass assignable.
 * @property array $guarded Attributes that are not mass assignable.
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public function category(): BelongsTo  {
        return $this->belongsTo(Category::class);
    }

}
