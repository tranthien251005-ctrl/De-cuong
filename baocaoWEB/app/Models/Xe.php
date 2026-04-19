<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ghe extends Model
{
    protected $table = 'vitrighe';
    protected $primaryKey = 'maghe';
    
    protected $fillable = [
        'tenghe',
        'trangthai',
        'maxe',
    ];
    
    // Quan hệ: một ghế thuộc về một xe
    public function xe()
    {
        return $this->belongsTo(Xe::class, 'maxe', 'maxe');
    }
}