<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'id_laboratory',
        'id_medicament',
        'stock',
        'price'
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class, 'id_laboratory');
    }

    public function medicament()
    {
        return $this->belongsTo(Medicament::class, 'id_medicament');
    }   
}
