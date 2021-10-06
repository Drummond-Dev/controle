<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function search($filter = null)
    {
        $result = $this->where('name', 'LIKE', "%{$filter}%")->paginate();

        return $result;
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }
}
