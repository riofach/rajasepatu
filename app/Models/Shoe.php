<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Shoe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'stock',
        'is_popular',
        'category_id',
        'brand_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function photos()
    {
        return $this->hasMany(ShoePhoto::class);
    }


    public function sizes()
    {
        return $this->hasMany(ShoeSize::class);
    }

    public function getThumbnailAttribute()
    {
        if ($this->attributes['thumbnail'] ?? null) {
            return $this->attributes['thumbnail'];
        }

        $firstPhoto = $this->photos->first();
        return $firstPhoto ? $firstPhoto->photo : null;
    }
}