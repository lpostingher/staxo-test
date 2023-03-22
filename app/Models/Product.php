<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    private const NO_IMAGE_PATH = '/img/no_image.png';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getImageUrlAttribute(): string
    {
        return $this->image_url ?? self::NO_IMAGE_PATH;
    }

    public function getPriceFormattedAttribute(): string
    {
        return "$" . number_format($this->price, 2);
    }
}
