<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // menambahkan kunci untuk dua field database
    protected $fillable = ['name', 'slug'];
}
