<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_uuid',
        'action',
        'transaction_number',
        'account',
        'debit',
        'credit',
        'created_by_id',
    ];

    public function asset() {
        return $this->belongsTo(Assets::class, 'asset_uuid', 'uuid');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by_id');
    }
} 