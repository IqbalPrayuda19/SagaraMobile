<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'created_by_id',
    ];

    public function assets () {
        return $this->hasMany(Assets::class);
    }
}
