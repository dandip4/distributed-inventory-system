<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Location;

class Transaction extends Model
{
    protected $connection = 'transaction';

    protected $fillable = [
        'transaction_number',
        'type',
        'source_location_id',
        'destination_location_id',
        'notes'
    ];

    protected $casts = [
        'transaction_date' => 'datetime'
    ];

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function sourceLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'source_location_id')
            ->withDefault(['location_name' => 'Lokasi Tidak Ditemukan']);
    }

    public function destinationLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'destination_location_id')
            ->withDefault(['location_name' => 'Lokasi Tidak Ditemukan']);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
