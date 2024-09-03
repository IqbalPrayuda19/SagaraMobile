<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Method;

class Assets extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'name',
        'location_id',
        'categories_id',
        'custom_number',
        'account_fixed_asset',
        'description',
        'accuisition_date',
        'accuisition_cost',
        'non_depreciation',
        'method',
        'usage_period',
        'usage_value_per_year',
        'depreciation_account',
        'accumulation_depreciation_account',
        'accumulation_depreciation_value',
        'depreciation_date',
        'created_by_id',
    ];

    public function categories () {
        return $this->belongsTo(Categories::class);
    }

    public function locations () {
        return $this->belongsTo(Locations::class);
    }

    protected function casts():array
    {
        return ['method'=>Method::class, ];
    }

}
