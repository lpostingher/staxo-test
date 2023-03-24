<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'amount', 'quantity', 'email', 'amount_received'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getIsFinishedAttribute(): bool
    {
        return $this->amount <= $this->amount_received;
    }

    public function getBalanceAttribute(): float
    {
        $balance = $this->amount - $this->amount_received;
        return max($balance, 0);
    }
}
