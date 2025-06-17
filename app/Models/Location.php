<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function stocks()
    {
        return $this->hasMany(LocationStock::class, 'location_id');
    }

    public function sourceTransactions()
    {
        return $this->hasMany(Transaction::class, 'source_location_id');
    }

    public function destinationTransactions()
    {
        return $this->hasMany(Transaction::class, 'destination_location_id');
    }
}
