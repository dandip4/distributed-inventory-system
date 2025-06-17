<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationStock extends Model
{
    protected $connection = 'location';
    protected $table = 'location_stocks';

    protected $fillable = [
        'location_id',
        'product_id',
        'quantity',
        'last_updated'
    ];

    protected $casts = [
        'last_updated' => 'datetime'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function product()
    {
        return $this->belongsTo(MasterProduct::class, 'product_id');
    }
}
