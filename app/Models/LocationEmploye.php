<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationEmploye extends Model
{
    protected $connection = 'location';
    protected $table = 'location_employes';
    protected $fillable = ['id', 'phone', 'address', 'position'];
    public $incrementing = false;

    public function master()
    {
        return $this->belongsTo(MasterEmploye::class, 'id', 'id');
    }
}
