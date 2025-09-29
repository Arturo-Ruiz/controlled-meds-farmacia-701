<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dispatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medicament_id',
        'amount',
        'reason',
        'current_stock',
        'final_stock'
    ];

    protected $casts = [
        'amount' => 'integer',
        'current_stock' => 'integer',
        'final_stock' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
    }
}
