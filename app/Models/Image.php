<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = ['url', 'tile'];

    public function book() : BelongsTo {
        return $this->belongsTo(Book::class);
    }

}
