<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * Represents a Tag entity in the application.
 *
 * This class extends Laravel's Eloquent Model and uses the HasFactory trait,
 * enabling it to interact with the database and utilize factories for testing.
 * It represents a tag that can be associated with posts.
 *
 * @property int $id The unique identifier for the tag.
 * @property string $name The name of the tag.
 */
class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name'];
}
