<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'presentation',
        'posological_units',
        'stock',
        'min_stock',
        'price',
        'expiration_date',
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'min_stock');
    }

    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('expiration_date', '<=', now()->addDays($days));
    }

    // Accessors  
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->name} - {$this->presentation}"
        );
    }

    protected function isLowStock(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->stock <= $this->min_stock
        );
    }

    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->expiration_date < now()
        );
    }
}
