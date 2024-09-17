<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory; //trait => collection of functions/methods //sharing/reuse
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        // 'code',
        'name',
    ];

    // protected $guarded = ['id']; // mass assignment vulnerability on very risky

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function order() {}
}
