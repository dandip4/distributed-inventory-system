<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterUnit extends Model
{
    protected $connection = 'master';

    protected $table = 'master_units';

    protected $fillable = [
        'unit_name',
        'unit_symbol'
    ];

    public function products()
    {
        return $this->hasMany(MasterProduct::class, 'unit_id');
    }
}
