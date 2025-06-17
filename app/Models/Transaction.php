<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $connection = 'transaction';

    protected $fillable = [
        'transaction_type',
        'source_location_id',
        'destination_location_id',
        'transaction_date',
        'reference_number',
        'notes',
        'created_by'
    ];

    protected $casts = [
        'transaction_date' => 'datetime'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    public function sourceLocation()
    {
        return $this->belongsTo(Location::class, 'source_location_id');
    }

    public function destinationLocation()
    {
        return $this->belongsTo(Location::class, 'destination_location_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
