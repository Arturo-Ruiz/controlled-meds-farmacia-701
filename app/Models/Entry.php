<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'laboratory_id',
        'medicament_id',
        'stock',
        'price'
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class, 'laboratory_id');
    }

    public function medicament()
    {
        return $this->belongsTo(Medicament::class, 'medicament_id');
    }   
}
