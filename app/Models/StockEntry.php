<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    protected $fillable = [
        'refno',
        'stock_in_by',
        'stock_in_date',
        'vendor_id',
        'size_id',
        'flavor_id',
        'description',
        'qty',
    ];

    protected $cast = [
        'stock_in_date' => 'date:Y-m-d'
    ];

    use HasFactory;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function flavor()
    {
        return $this->belongsTo(Flavor::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

}
