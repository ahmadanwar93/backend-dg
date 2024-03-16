<?php

namespace App\Models;

use App\Enums\ProductCategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id'];

    protected $casts = [
        'category' => ProductCategoryEnum::class
    ];

    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class);
    // }
}
