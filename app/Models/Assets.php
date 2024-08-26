<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'locations_id',
        'categories_id',
        'custom_number',
        'account_fixed_asset',
        'description',
        'accuisition_date',
        'accuisition_cost',
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

}
