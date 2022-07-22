<?php

namespace App\Models;

use App\Models\Traits\FormatPrices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, FormatPrices;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant',
        'quantity',
        'price',
    ];

    public function getSelfWithProductInfo()
    {
        $this->name = $this->product->name;
        $this->id = $this->product->id;
        return $this;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
