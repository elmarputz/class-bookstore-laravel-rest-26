<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = ['isbn', 'title', 'subtitle', 'published',
        'rating', 'description', 'user_id'];


    public function images() : HasMany {
        return $this->hasMany(Image::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function authors() : BelongsToMany {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    public function isFavourite() : bool {
        return $this->rating >= 7;
    }

    // query scope
    public function scopeFavourite($query) {
        return $query->where('rating', '>=', 7);
    }
}
