<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Actually a product model
 */
class Flavor extends Model
{
    use HasFactory;

    protected $fillable = [
        'pcode',
        'barcode',
        'name',
        'brand_id',
        'category_id',
        'size_id',
        'price',
        'reorder'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function stockEntry()
    {
      return $this->belongsTo(StockEntry::class);
    }

}
