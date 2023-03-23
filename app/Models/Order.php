<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'amount', 'quantity', 'email'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
