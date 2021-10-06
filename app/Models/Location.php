<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = ['name', 'uf'];

    public function search($filter = null)
    {
        $result = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('uf', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $result;
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
