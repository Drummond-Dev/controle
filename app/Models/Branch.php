<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $fillable = ['company_id', 'location_id', 'cnpj'];

    public function search($filter = null)
    {
        $result = $this->where('cnpj', 'LIKE', "%{$filter}%")
            ->paginate();

        return $result;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
