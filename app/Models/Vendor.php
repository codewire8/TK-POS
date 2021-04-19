<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_person',
        'contact_person_telno',
        'contact_person_email'
    ];

    public function vendor()
    {
       $this->belongsTo(StockEntry::class);
    }
}
