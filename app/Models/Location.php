<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    protected $connection = 'location';
    protected $table = 'locations';

    protected $fillable = [
        'location_name',
        'address',
        'city',
        'country'
    ];

    public function stocks(): HasMany
    {
        return $this->hasMany(LocationStock::class, 'location_id');
    }

    public function sourceTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'source_location_id')
            ->withDefault();
    }

    public function destinationTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'destination_location_id')
            ->withDefault();
    }
}
