<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LocationEmploye;

class MasterEmploye extends Model
{
    protected $connection = 'master';
    protected $table = 'master_employes';
    protected $fillable = ['name', 'email', 'is_active'];

    public function locationDetail()
    {
        return $this->hasOne(LocationEmploye::class, 'id', 'id');
    }
}
