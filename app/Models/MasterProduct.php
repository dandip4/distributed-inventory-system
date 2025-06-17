<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterProduct extends Model
{
    protected $connection = 'master';
    protected $table = 'master_products';

    protected $fillable = [
        'product_code',
        'product_name',
        'category_id',
        'unit_id',
        'min_stock',
        'max_stock',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(MasterCategory::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(MasterUnit::class, 'unit_id');
    }

    public function stocks()
    {
        return $this->hasMany(LocationStock::class, 'product_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }
}
