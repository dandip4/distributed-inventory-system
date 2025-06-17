<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    protected $connection = 'master';
    protected $table = 'master_categories';

    protected $fillable = [
        'category_name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(MasterProduct::class, 'category_id');
    }
}
