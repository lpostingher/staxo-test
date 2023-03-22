<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    private const NO_IMAGE_PATH = '/img/no_image.png';

    protected $fillable = ['name', 'price', 'image_path'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getImageUrlAttribute(): string
    {
        return $this->image_path ?? self::NO_IMAGE_PATH;
    }

    public function getPriceFormattedAttribute(): string
    {
        return "$" . number_format($this->price, 2);
    }
}
