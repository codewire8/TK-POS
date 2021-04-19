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
        'flavor_id',
        'qty',
    ];

    protected $cast = [
        'stock_in_date' => 'date:Y-m-d'
    ];

    use HasFactory;

    public function stockEntry()
    {
        $this->hasOne(Vendor::class);
    }


}
