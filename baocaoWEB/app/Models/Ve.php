<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    protected $table = 've';
    protected $primaryKey = 'mave';
    public $timestamps = false;

    protected $fillable = [
        'mave',
        'maghe',
        'mataikhoan',
        'ngaydat',
        'trangthaithanhtoan',
        'tongsotien',
    ];
}
