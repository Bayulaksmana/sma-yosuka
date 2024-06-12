<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    //fungsi keamanan database
    protected $fillable = ['category_id', 'title', 'name', 'slug', 'description', 'image', 'views', 'status', 'publish_date'];

    //cara membuat relasi table
    public function category(): BelongsTo
    {
        return $this->BelongsTo(category::class);
    }
}
